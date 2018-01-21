<?php
namespace frontend\models;
use yii\base\Model;

use Yii;
use common\models\PostModel;
use common\models\RelationPostTagModel;
use yii\db\Query;

class PostForm extends Model
{
	public $id;
	public $title;
	public $content;
	public $label_img;
	public $cat_id;
	public $tags;

	public $_lastError = "";

	const SCENARIOS_CREATE = 'create';
	const SCENARIOS_UPDATE = 'update';

	const EVENT_AFTER_CREATE = "eventAfterCreate";
	const EVENT_AFTER_UPDATE = "eventAfterUpdate";

	public function rules()
	{
		return [
			[['id', 'title', 'content', 'cat_id'], 'required'],
			[['id', 'cat_id'], 'integer'],
			['title', 'string', 'min'=>4, 'max'=>50],
		];
	}

	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'label_img' => 'Label Image',
			'tags' => 'Tags',
			'cat_id' => 'Category'
		];
	}

	// override scenarios()
	public function scenarios()
	{
		$scenarios = [
			self::SCENARIOS_CREATE => ['title', 'content', 'label_img', 'cat_id', 'tags'],
			self::SCENARIOS_UPDATE => ['title', 'content', 'label_img', 'cat_id', 'tags'],
		];
		return array_merge(parent::scenarios(), $scenarios);
	}

	public function create()
	{
		$transaction = Yii::$app->db->beginTransaction();
		try {
			$model = new PostModel();
			$model->setAttributes($this->attributes);
			$model->summary = $this->_getSummary();
			$model->user_id = Yii::$app->user->identity->id;
			$model->user_name = Yii::$app->user->identity->username;
			$model->is_valid = PostModel::IS_VALID;
			$model->created_at = time();
			$model->updated_at = time();
			if(!$model->save()) {
				throw new \Exception('Saving Post Fails!');
			}
			$this->id = $model->id;
			
			$data = array_merge($this->getAttributes(), $model->getAttributes());
			$this->_eventAfterCreate($data);

			$transaction->commit();
			return true;
		} catch (\Exception $e) {
			$transaction->rollBack();
			$this->_lastError = $e->getMessage();
			return false;
		}
	}

	// _getSummary(start, end, type)
	private function _getSummary($s = 0, $e = 90, $char = "utf-8")
	{
		if(empty($this->content)){
			return null;
		}

		// replace space into ''
		// filter out tag, e.g. delete <p>
		return (mb_substr(str_replace('&nbsp;', '', strip_tags($this->content)), $s, $e, $char));
	}

	// event after creating post
	public function _eventAfterCreate($data)
	{
		// add event about adding tag to EVENT_AFTER_CREATE
		$this->on(self::EVENT_AFTER_CREATE, [$this, '_eventAddTag'], $data);

		// trigger event
		$this->trigger(self::EVENT_AFTER_CREATE);

	}

	// add tag event
	public function _eventAddTag($event)
	{
		$tag = new TagForm();
		$tag->tags = $event->data['tags'];
		$tagIds = $tag->saveTags();

		// delete the current tag relation
		RelationPostTagModel::deleteAll(['post_id' => $event->data['id']]);

		// save the latest relation of post and tag
		if(!empty($tagIds)) {
			foreach($tagIds as $k=>$id) {
				$row[$k]['post_id'] = $this->id;
				$row[$k]['tag_id'] = $id;
			}

			$res = (new Query())->createCommand()->batchInsert(RelationPostTagModel::tableName(), ['post_id', 'tag_id'], $row)->execute();
			if(!$res) {
				throw new \Exception("Save Relation Fail!");
			}
		} 
	}

	public function getViewById($id)
	{
		// get data by id from post table
		// we connect to relate table first (getRelate)
		// then tag table (getTag)
		$res = PostModel::find()->with('relate.tag', 'extend')->where(['id'=>$id])->asArray()->one();

		if(!$res) {
			throw new NotFoundHttpException('Post Not Found');
		}

		// print_r($res);exit;
		// when with('relate')
		// Array
		// (
		//     [id] => 132
		//     [title] => test tagsss
		//     [summary] => gregegergerg
		//     [content] => <p>gregegergerg</p>
		//     [label_img] => /image/20180121/1516566233245785.jpg
		//     [cat_id] => 6
		//     [user_id] => 2
		//     [user_name] => abc
		//     [is_valid] => 1
		//     [created_at] => 1516566292
		//     [updated_at] => 1516566292
		//     [relate] => Array
		//         (
		//             [0] => Array
		//                 (
		//                     [id] => 66
		//                     [post_id] => 132
		//                     [tag_id] => 49
		//                 )

		//             [1] => Array
		//                 (
		//                     [id] => 67
		//                     [post_id] => 132
		//                     [tag_id] => 50
		//                 )

		//         )

		// )
	
	// ->

		// when with('relate.tag')
		// [relate] => Array
		//         (
		//             [0] => Array
		//                 (
		//                     [id] => 66
		//                     [post_id] => 132
		//                     [tag_id] => 49
		//                     [tag] => Array
	 //                        (
	 //                            [id] => 49
	 //                            [tag_name] => tag33
	 //                            [post_num] => 1
	 //                        )

		//                 )

		//             [1] => Array
		//                 (
		//                     [id] => 67
		//                     [post_id] => 132
		//                     [tag_id] => 50
		//                     [tag] => Array
	 //                        (
	 //                            [id] => 50
	 //                            [tag_name] => tag99
	 //                            [post_num] => 1
	 //                        )
		//                 )

		//         )


		// deal with tag format
		$res['tags'] = [];
		if(isset($res['relate']) && !empty($res['relate']))
		{
			foreach($res['relate'] as $list) {
				$res['tags'][] = $list['tag']['tag_name'];
			}
		}

		unset($res['relate']);

		// print_r($res); exit;
		// when with('relate.tag') after unset and changing tag format
		//     [tags] => Array
		//         (
		//             [0] => tag33
		//             [1] => tag99
		//         )

		return $res;

	}

}
<?php
namespace frontend\models;
use yii\base\Model;

use Yii;
use common\models\PostModel;

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
			self::SCENARIOS_CREATE => ['title', 'content', 'labe_img', 'cat_id', 'tags'],
			self::SCENARIOS_UPDATE => ['title', 'content', 'labe_img', 'cat_id', 'tags'],
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
			$this->_eventAfterCreate();

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

	public function _eventAfterCreate()
	{

	}

}
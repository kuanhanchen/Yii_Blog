<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\TagModel;

class TagForm extends Model
{
	public $id;
	public $tags;

	public function rules()
	{
		return [
			['tags', 'required'],
			['tags', 'each', 'rule'=>['string']],
		];
	}

	public function saveTags()
	{
		$ids = [];
		if(!empty($this->tags)) {
			foreach($this->tags as $tag) {
				$ids[] = $this->_saveTag($tag);
			}
		}
		return $ids;
	}

	private function _saveTag($tag)
	{
		$model = new TagModel();
		$res = $model->find()->where(['tag_name'=>$tag])->one();

		if(!$res) {
			$model->tag_name = $tag;
			$model->post_num = 1;
			if(!$model->save()) {
				throw new \Exception("Save Tag Fail!");
			}
			return $model->id;
		} else {
			// means post_num++
			$res->updateCounters(['post_num'=>1]);
		}
		return $res->id;
	}
}
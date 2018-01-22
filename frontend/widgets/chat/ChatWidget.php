<?php
namespace frontend\widgets\chat;

use Yii;
use yii\bootstrap\Widget;
use yii\base\Object;
use frontend\models\FeedForm;
use common\models\FeedModel;

class ChatWidget extends Widget
{
	public function run()
	{
		$feed = new FeedForm();
		$data['feed'] = $feed->getList();
		return $this->render('index', ['data'=>$data]);
	}
}
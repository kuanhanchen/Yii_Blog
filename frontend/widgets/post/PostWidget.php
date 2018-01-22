<?php
namespace frontend\widgets\post;

use Yii;
use yii\base\Widget;
use common\models\PostModel;
use frontend\models\PostForm;
use yii\helpers\Url;
use yii\data\Pagination;

class PostWidget extends Widget
{
	public $title = '';
	public $limit = 6;	// max number of title
	public $more = true;	// whether shown more
	public $page = true;	// whether shown pagination

	public function run()
	{	
		// in yii request, there's a parameter, page
		// get page parameter, if not exist, we set page = 1
		$curPage = Yii::$app->request->get('page', 1);

		// condition, we only get posts with isvalid = 1 = IS_VALID
		$cond = ['=', 'is_valid', PostModel::IS_VALID];

		// 
		$res = PostForm::getList($cond, $curPage, $this->limit);

		// if we don't set $this->title when call this widget
		// we'll get default value, "Latest Post"
		$result['title'] = $this->title?:"Latest Post";
		$result['more'] = Url::to(['post/index']);
		$result['body'] = $res['data']?:[];

		// $this->page: whether shown pagination
		if($this->page) {
			$pages = new Pagination(['totalCount'=>$res['count'], 'pageSize'=>$res['pageSize']]);

			$result['page'] = $pages;
		}
			return $this->render('index', ['data'=>$result]);
	}
}
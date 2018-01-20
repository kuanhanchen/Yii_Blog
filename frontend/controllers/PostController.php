<?php

	namespace frontend\controllers;

	use Yii;
	use frontend\controllers\base\BaseController;
	use frontend\models\PostForm;
	use common\models\CatModel;

	class PostController extends BaseController
	{
		// post list
		public function actionIndex()
		{
			return $this->render('index');
		}

		// Create Post
		public function actionCreate()
		{
			$model = new PostForm();

			// get all categories from database
			$cat = CatModel::getAllCats();
			return $this->render('create', ['model' => $model, 'cat'=>$cat]);

		}
	}
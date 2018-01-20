<?php

	namespace frontend\controllers;

	use Yii;
	use frontend\controllers\base\BaseController;
	use frontend\models\PostForm;

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
			return $this->render('create', ['model' => $model]);

		}
	}
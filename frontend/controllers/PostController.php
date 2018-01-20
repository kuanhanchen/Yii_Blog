<?php

	namespace frontend\controllers;

	use Yii;
	use frontend\controllers\base\BaseController;

	class PostController extends BaseController
	{
		// post list
		public function actionIndex()
		{
			return $this->render('index');
		}
	}
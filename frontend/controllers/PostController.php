<?php

	namespace frontend\controllers;

	use Yii;
	use frontend\controllers\base\BaseController;
	use frontend\models\PostForm;
	use common\models\CatModel;

	class PostController extends BaseController
	{
		public function actions()
	    {
	        return [
	            'upload'=>[
	                'class' => 'common\widgets\file_upload\UploadAction',
	                'config' => [
	                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
	                ]
	            ]
	        ];
	    }
    
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
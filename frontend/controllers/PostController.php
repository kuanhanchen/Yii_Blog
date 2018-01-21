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
	            ],
			    'ueditor'=>[
			        'class' => 'common\widgets\ueditor\UeditorAction',
			        'config'=>[
			            'imageUrlPrefix' => "",
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

			// define scenarios
			$model->setScenario(PostForm::SCENARIOS_CREATE);
			if($model->load(Yii::$app->request->post()) && $model->validate()) {
				if(!$model->create()) {
					Yii::$app->session->setFlash('warning', $model->_lastError);
				} else {
					return $this->redirect(['post/view', 'id'=>$model->id]);
				}
			}

			// get all categories from database
			$cat = CatModel::getAllCats();

			// render to post/create, so in post/create view, we can use $model and $cat
			return $this->render('create', ['model' => $model, 'cat'=>$cat]);

		}
	}
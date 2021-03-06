<?php

	namespace frontend\controllers;

	use Yii;
	use frontend\controllers\base\BaseController;
	use frontend\models\PostForm;
	use common\models\CatModel;
	use yii\filters\VerbFilter;
	use yii\filters\AccessControl;
	use common\models\PostExtendModel;

	class PostController extends BaseController
	{
		public function behaviors()
	    {
	        return [
	            'access' => [
	                'class' => AccessControl::className(),
	                'only' => ['index', 'create', 'upload', 'ueditor'],
	                'rules' => [
	                    [
	                    	// 'roles' => ['?'] means access only for logout
	                    	// so here we delete it to make no matter login or not, we can access index
	                        'actions' => ['index'],
	                        'allow' => true,
	                        // 'roles' => ['?'],
	                    ],
	                    [	
	                    	// @ means access only for login
	                        'actions' => ['create', 'upload', 'ueditor'],
	                        'allow' => true,
	                        'roles' => ['@'],
	                    ],
	                ],
	            ],
	            'verbs' => [
	                'class' => VerbFilter::className(),
	                'actions' => [
	                	// all methods can use get and post
	                	'*' => ['get', 'post']
	                ],
	            ],
	        ];
	    }

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

		public function actionView($id)
		{
			// get data by id from post table
			$model = new PostForm();
			$data = $model->getViewById($id);

			// get related numbers of post from postextends table
			$model = new PostExtendModel();
			$model->upCounter(['post_id'=>$id], 'browser', 1);

			return $this->render('view', ['data'=>$data]);
		}

		
		// update
		public function actionUpdate($id)
	    {
	        $model = new PostForm();
	        $model->setScenario(PostForm::SCENARIOS_CREATE);
	        $model->getupdate($id);
	        if ($model->load(Yii::$app->request->post()) && $model->validate()){
	            if (!$model->update($id)){
	                Yii::$app->session->setFlash('warning', $model->_lastError);
	            }else{
	                return $this->redirect(['post/view','id'=>$model->id]);
	            }
	        }
	        $cats = CatModel::getAllCats();
	        return $this->render('update',['model'=>$model,'cats' => $cats]);
	    }
	}
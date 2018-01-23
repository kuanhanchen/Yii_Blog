<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            // 'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'email_validate_token:email',
            'email:email',
            //'role',
            'status'=>[
                'label'=>'STATUS',
                'attribute'=>'status',
                'value'=>function($model) {
                    return ($model->status==10)?'Active':'Inactive';
                },
                'filter'=>['0'=>'Inactive', '10'=>'Active'],
            ],
            'avatar',
            // 'vip_lv',
            'created_at:datetime',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

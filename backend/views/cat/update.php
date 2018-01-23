<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CatModel */

$this->title = 'Update Category: ' . $model->cat_name;
$this->params['breadcrumbs'][] = ['label' => 'Category List', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cat-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

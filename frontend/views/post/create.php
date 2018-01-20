<?php
	
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
// use common\models\CatModel;

// create breadcrumbs: Home/Post/Create
$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label'=>'Post', 'url'=>['post/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>.page-header{margin-top: 0px;}.page-header h1{font-size: 18px;margin: 4px 0;display:inline-block; }.box-title{color: #333;font-size: 18px;border-bottom: 2px solid #cbcbcb;padding-bottom: 5px;}.panel-body{padding: 15px 0 5px 0;}</style>


<div class="row">
	<div class="col-lg-9">
		<div class="panel-title box-title">
			<span>Create Post</span>
		</div>
		<div class="panel-body">
			<?php $form = ActiveForm::begin()?>
			
			<?=$form->field($model, 'title')->textinput(['maxlength'=>true])?>
			
			<?=$form->field($model, 'cat_id')->dropDownList($cat)?>

			<?=$form->field($model, 'label_img')->textinput(['maxlength'=>true])?>

			<?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload',[
		        'config'=>[]
		    ]) ?>
			
			<?=$form->field($model, 'content')->textinput(['maxlength'=>true])?>

			<?=$form->field($model, 'tags')->textinput(['maxlength'=>true])?>
			
			<div class="form-group">
				<?=Html::submitButton("Submit", ['class'=>'btn btn-success'])?>
			</div>

			<?php activeForm::end()?>
		</div>
	</div>
	<div class="col=lg-3">
		<div class="panel-title box-title">
			<span>Notes</span>
		</div>
		<div class="panel-body">
			<p>1. gljsdfvn</p>
			<p>2. sczgtnvb</p>
		</div>
	</div>
</div>

<?php
use frontend\widgets\post\PostWidget;
use yii\base\Widget;
use frontend\widgets\hot\HotWidget;
use yii\helpers\Url;
?>
<div class="row">
	<div class="col-lg-9">
		<?=PostWidget::widget();?>
	</div>
	<div class="col-lg-3">
		
		<div class="panel">
			<?php if(!\Yii::$app->user->isGuest):?>
				<a class="btn btn-success btn-block btn-post" href="<?Url::to(['post/create'])?>">Create Post</a>
			<?php endif;?>
		</div>
		
		<?=HotWidget::widget();?>
	</div>
</div>
<?php
use yii\helpers\Url;
use frontend\widgets\hot\HotWidget;
$this->title = $data['title'];
$this->params['breadcrumbs'][] = ['label'=>'Post', 'url'=>['post/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.page-title {
    border-bottom: 1px solid #eee;
    margin-bottom: 10px;
    padding-bottom: 5px;
}

.page-title h1 {
    font-size: 18px;
    margin: 4px 0 10px;
}

.page-title span {
    color: #999;
    font-size: 12px;
    margin-right: 5px;
}

.page-content {
    border-bottom: 1px solid #eee;
    margin-bottom: 10px;
    min-height: 400px;
}
</style>

<div class="row">
	<div class="col-lg-9">
		<div class="page-title">
			<h1><?=$data['title']?></h1>
			<span>Author: <?=$data['user_name']?></span>
			<span>Published Date: <?=date('Y-m-d',$data['created_at'])?></span>
			<span>Viewed: <?=isset($data['extend']['browser'])?$data['extend']['browser']:0?></span>
		</div>
	
		<div class="page-content">
			<?=$data['content']?>
		</div>

		<div class="page-tag">
		Tag:
			<?php foreach($data['tags'] as $tag): ?>
			<span><a href="#"><?=$tag?></a></span>
			<?php endforeach;?>
		</div>
	</div>
	<div class="col-lg-3">
		
		<div class="panel">
			<?php if(!\Yii::$app->user->isGuest):?>
				<a class="btn btn-success btn-block btn-post" href="<?=Url::to(['post/create'])?>">Create Post</a>
				<?php if(\Yii::$app->user->identity->id == $data['user_id']):?>
					<a class="btn btn-info btn-block btn-post" href="<?=Url::to(['post/update', 'id'=>$data['id']])?>">Edit Post</a>
				<?php endif;?>
			<?php endif;?>
		</div>

		<?=HotWidget::widget();?>
	</div>
</div>
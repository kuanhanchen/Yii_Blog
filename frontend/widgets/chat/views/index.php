<?php
use yii\helpers\Url;
?>

<style>
.border-bottom {
    border-bottom: 1px solid #ccc;
}

.panel-body .media-feed {
    font-size: 12px;
    line-height: 1.5em;
}

.panel-body .media-feed .media .media-object {
    width: 40px;
    height: 40px;
    padding: 1px;
    border: #ddd solid 1px;
}

.panel-body .media-feed .media-action {
    margin-top: 5px;
}

.panel-body {
	padding-left:0px;
	padding-right:0px;
}

.feed .panel-body {
	padding-bottom:0px;
}
.btn-feed {
	height:50px;
	border-radius:0px;
}

.form-group textarea {
    height: 50px;
    resize: none;
    font-size: 12px;
}

.panel-body .media-feed {
    height: 360px;
    position: relative;
	word-break: break-all;
	overflow:auto;
}

.panel-body ul {
    padding: 0;
    margin: 0;
}
</style>

<div class="panel-title box-title" style="border-bottom:none">
	<span><strong>Message Board</strong></span>
	<span class="pull-right"><a href="" class="font-12">More>></a></span>
</div>
<div class="pannel-boy">
	<form id="w0" action="/" method="post">
		<div class="form-group input-group field-feed-content required">
			<textarea name="" id="feed-content" cols="30" rows="10" class="form-control" name="content"></textarea>
		
			<span class="input-group-btn">
				<button type="button" data-url="<?=Url::to(['site/add-feed'])?>" class='btn btn-success btn-feed j-feed'>Send</button>
			</span>
		</div>
	</form>

	<?php if(!empty($data['feed'])):?>
	<ul class="media-list media-feed feed-index ps-container ps-active-y">
		<?php foreach($data['feed'] as $list):?>
		<li class="media">
			<div class="media-left">
				<a href="#" rel="author" data-original-title="" title="">
					<img width="30px" src="<?=$list['user']['avatar'];?>"/>
				</a>
			</div>
			<div class="media-body" style="font-size: 12px;">
				<div class="media-content">
					<?=$list['user']['username']?>Say: <?=$list['content']?>
				</div>
				<div class="media-action">
					<?=date('Y-m-d h:i:s',$list['created_at'])?>
				</div>
			</div>
		</li>
		<?php endforeach;?>
	</ul>
	<?php endif;?>
</div>
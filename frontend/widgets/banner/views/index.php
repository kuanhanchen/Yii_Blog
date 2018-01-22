<?php
use yii\helpers\Url;
?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">

	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php foreach ($data['items'] as $k=>$list):?>
		<li data-target="#myCarousel" data-slide-to=<?=$k ?> class="<?=(isset($list['active']) && $list['active'])?'active':'' ?>"></li>
		<?php endforeach;?>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<?php foreach ($data['items'] as $k=>$list):?>
		<div class="item <?=(isset($list['active']) && $list['active'])?'active':''?>">
			<a href="<?=Url::to($list['url']) ?>">
				<img style="width:848px;height:300px" src="<?=$list['image_url']?>" alt="<?=$list['label']?>">
				<div class="carousel-caption">
					<?=$list['html']?>
				</div>
			</a>
		</div>
		<?php endforeach;?>
	</div>

	<!-- Left and right controls -->

	<a class="carousel-control left" href="#myCarousel" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>

	</a>

	<a class="carousel-control right" href="#myCarousel" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
	</a>

</div>
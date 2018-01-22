<?php
use frontend\widgets\banner\BannerWidget;
use yii\base\Widget;
use frontend\widgets\post\PostWidget;
/* @var $this yii\web\View */
$this->title = 'Greg Yii Blog';
?>

<div class="row">
    <div class="col-lg-9">
        <!-- Carousel -->
        <?=BannerWidget::widget()?>
    </div>
    <div class="col-lg-3">
    </div>

    <div class="col-lg-9">
        <!-- Post List -->
        <?=PostWidget::widget()?>
    </div>

</div>
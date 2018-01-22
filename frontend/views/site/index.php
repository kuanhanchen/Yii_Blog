<?php
use frontend\widgets\banner\BannerWidget;
use yii\base\Widget;
use frontend\widgets\post\PostWidget;
use frontend\widgets\chat\ChatWidget;
use frontend\widgets\hot\HotWidget;
use frontend\widgets\tag\TagWidget;
/* @var $this yii\web\View */
$this->title = 'Greg Yii Blog';
?>

<div class="row">
    <div class="col-lg-9">
        <!-- Carousel -->
        <?=BannerWidget::widget()?>

        <!-- Post List -->
        <?=PostWidget::widget()?>
    </div>
    <div class="col-lg-3">
        <!-- Chat -->
        <?=ChatWidget::widget()?>
        <!-- Popular Post List -->
        <?=HotWidget::widget()?>
        <!-- Tag List -->
        <?=TagWidget::widget()?>
    </div>
</div>
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use backend\widgets\sidebar\SidebarWidget;
use yii\bootstrap\Modal;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header>
    <div class="headerpanel">
        <div class="logopanel">
            <h2><a href="#">Blog CMS</a></h2>
        </div><!-- logopanel -->
        
        <div class="headerbar">
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

            <div class="searchpanel">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                    </span>
                </div><!-- input-group -->
            </div>

            <div class="header-right">
                <ul class="headermenu">
                    <li>
                    <div id="noticePanel" class="btn-group">
                        <button class="btn btn-notice alert-notice" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-commenting"></i>
                        </button>
                        <div id="noticeDropdown" class="dropdown-menu dm-notice pull-right">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li class="active"><a data-target="#notification" data-toggle="tab">Messages（2）</a></li>
                                <li><a data-target="#reminders" data-toggle="tab">Reminds（4）</a></li>
                            </ul>
    
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="notification">
                                    <ul class="list-group notice-list">
                                        <li class="list-group-item unread">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                <div class="col-xs-10">
                                                    <h5><a href="#">Message</a></h5>
                                                    <small>2015-12-27</small>
                                                    <span>Summary</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <a class="btn-more" href="">View All Messages <i class="fa fa-long-arrow-right"></i></a>
                                </div><!-- tab-pane -->
    
                                <div role="tabpanel" class="tab-pane" id="reminders">
                                    <h1 id="todayDay" class="today-day"></h1>
                                    <h3 id="todayDate" class="today-date"></h3>
                                    <h4 class="panel-title">Expired</h4>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <h4>20</h4>
                                                    <p>Aug</p>
                                                </div>
                                                <div class="col-xs-10">
                                                    <h5><a href="">HTML5/CSS3 Live! United States</a></h5>
                                                    <small>San Francisco, CA</small>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <a class="btn-more" href="">View More Reminds <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </li>
                    
                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-logged" data-toggle="dropdown">
                                <img src="<?=Yii::$app->params['avatar']['small'] ?>" alt="avatar">
                                <?=Yii::$app->user->identity->username?>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="#"><i class="fa fa-user"></i>Personal Center</a></li>
                                <li><a href="#"><i class="fa fa-cog"></i>Account Setting</a></li>
                                <li><a href="<?=Url::to(['site/logout'])?>" data-method="post" ><i class="fa fa-sign-out"></i>Log Out</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div><!-- header-right -->
        </div><!-- headerbar -->
    </div><!-- header-->
</header>

<section>

<div class="leftpanel">
    <div class="leftpanelinner">

      <!-- ################## LEFT PANEL PROFILE ################## -->

    <div class="media leftpanel-profile">
        <div class="media-left">
            <a href="#">
                <img src="<?=Yii::$app->params['avatar']['small']?>" alt="" class="media-object img-circle">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading"><?=Yii::$app->user->identity->username?><a data-toggle="collapse" data-target="#loguserinfo" class="pull-right"><i class="fa fa-angle-down"></i></a></h4>
            <span>Admin</span>
        </div>
    </div><!-- leftpanel-profile -->

    <div class="leftpanel-userinfo collapse" id="loguserinfo">
        <h5 class="sidebar-title">Address</h5>
        <address>123 45th St. Los Angeles, CA</address>
        <h5 class="sidebar-title">Contact</h5>
        <ul class="list-group">
            <li class="list-group-item">
                <label class="pull-left">Email</label>
                <span class="pull-right">greg@greg.com</span>
            </li>
            <li class="list-group-item">
                <label class="pull-left">Phone</label>
                <span class="pull-right">123-456-7890</span>
            </li>
            <li class="list-group-item">
                <label class="pull-left">Mobile</label>
                <span class="pull-right">123-456-7890</span>
            </li>
            <li class="list-group-item">
                <label class="pull-left">Social App</label>
                <div class="social-icons pull-right">
                    <a href="#"><i class="fa fa-facebook-official"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                </div>
            </li>
        </ul>
    </div><!-- leftpanel-userinfo -->
    <div class="tab-content">
    
        <div class="tab-pane active" id="mainmenu">
            <h5 class="sidebar-title">Menu</h5>
            <!-- sidebar组件 -->
            <?=SidebarWidget::widget([
                'encodeLabels' => false,
            ])?>
        </div>
    </div><!-- tab-content -->

    </div><!-- leftpanelinner -->
</div><!-- leftpanel -->

  <div class="mainpanel">
    <div class="contentpanel">
        <?= Breadcrumbs::widget([
            'homeLink'=>[
                'label' => '<i class="fa fa-home mr5"></i> '.Yii::t('yii', 'Home'),
                'url' => '/',
                'encode' => false,
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'tag'=>'ol',
            'options' => ['class' => 'breadcrumb breadcrumb-quirk']
        ]) ?>                
        <hr class="darken"> 
        <?= Alert::widget() ?>       
        <?=$content?>
    </div>
    
  </div><!-- mainpanel -->

</section>

<?php Modal::begin([    
    'id' => 'create-modal',    
    'header' => '<h4 class="modal-title"></h4>',    
]); 
Modal::end();
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

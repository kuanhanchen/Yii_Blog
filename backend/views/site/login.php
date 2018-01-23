<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Log In';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sign-overlay"></div>
<div class="signpanel"></div>

<div class="panel signin">
    <div class="panel-heading">
        <h4 class="panel-title">Welcome to Login Blog System</h4>
    </div>
    <div class="panel-body">
      
        <button class="btn btn-primary btn-quirk btn-fb btn-block">Contact Us</button>

        <div class="or">or</div>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <!-- label(false), delete label text, Username -->
            <?= $form->field($model, 'username', [
                'inputOptions' => [
                    'placeholder' => 'Account Name',
                ],
                'inputTemplate' => 
                    '<div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        {input}
                    </div>',
            ])->label(false) ?>

            <?= $form->field($model, 'password', [
                'inputOptions' => [
                    'placeholder' => 'Password',
                ],
                'inputTemplate' => 
                    '<div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        {input}
                    </div>',
            ])->passwordInput()->label(false) ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div><a href="#" class="forgot">Forgot Password?</a></div>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-success btn-quirk btn-block', 'name' => 'login-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>

        <hr class="invisible">
        <div>
            <a href="#" class="btn btn-default btn-quirk btn-stroke-thin btn-block">NOT A MEMBER? SIGN UP NOW</a>
        </div>
    </div>
</div><!-- panel -->
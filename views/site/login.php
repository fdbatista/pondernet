<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\controllers\SiteController;

$this->title = SiteController::translate('Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= SiteController::translate('Please fill out the following fields to login:') ?>
    </p>
    
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('username'), 'class' => 'form-control']])->textInput()->label(false) ?>
                <?= $form->field($model, 'password', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('password'), 'class' => 'form-control']])->passwordInput()->label(false) ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    <?= SiteController::translate('If you forgot your password, you can') ?>
                    <?= Html::a(SiteController::translate('reset it here'), ['site/request-password-reset']) ?>.<br/>
                    <?= SiteController::translate('You may also ') . Html::a(SiteController::translate('register for free'), ['site/signup']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton(SiteController::translate('Accept'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

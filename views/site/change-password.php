<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\controllers\SiteController;

$this->title = SiteController::translate('Change password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>
                
                <?= $form->field($model, 'old_password', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('old_password'), 'class' => 'form-control']])->passwordInput()->label(false) ?>
                <?= $form->field($model, 'new_password', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('new_password'), 'class' => 'form-control']])->passwordInput()->label(false) ?>
                <?= $form->field($model, 'confirmation', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('confirmation'), 'class' => 'form-control']])->passwordInput()->label(false) ?>
                
                <div class="form-group">
                    <?= Html::submitButton(SiteController::translate('Accept'), ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

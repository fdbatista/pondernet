<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\controllers\SiteController;
use yii\web\YiiAsset;

$this->title = SiteController::translate('Contact');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= SiteController::translate('If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.') ?>
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('name'), 'class' => 'form-control']])->label(false) ?>
                <?= $form->field($model, 'email', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('email'), 'class' => 'form-control']])->label(false) ?>
                <?= $form->field($model, 'subject', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('subject'), 'class' => 'form-control']])->label(false) ?>
                <?= $form->field($model, 'body', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('body'), 'class' => 'form-control']])->textArea(['rows' => 6])->label(false) ?>
                <?= $form->field($model, 'verifyCode', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('verifyCode'), 'class' => 'form-control']])->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton(SiteController::translate('Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    
</div>

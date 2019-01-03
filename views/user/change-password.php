<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Cambiar contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('msjError')): ?>
        <div style="margin-bottom: 10px;">
            <strong class="label label-danger"><?=Yii::$app->session->getFlash('msjError')?></strong>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'old_password')->passwordInput() ?>
                <?= $form->field($model, 'new_password')->passwordInput() ?>
                <?= $form->field($model, 'confirmation')->passwordInput() ?>
                
                <div class="form-group">
                    <?= Html::submitButton('Aceptar', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

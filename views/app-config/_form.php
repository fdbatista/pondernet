<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'activar_log')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Aceptar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

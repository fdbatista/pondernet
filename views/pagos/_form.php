<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pagos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagos-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'pagado')->checkbox() ?>
    
    <!--
    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput() ?>
        
    <?= $form->field($model, 'pagado_por')->textInput() ?>

    <?= $form->field($model, 'fecha_solic')->textInput() ?>

    <?= $form->field($model, 'fecha_pagado')->textInput() ?>
    -->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Actualizar'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\PagosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_usuario') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'pagado')->checkbox() ?>

    <?php // echo $form->field($model, 'pagado_por') ?>

    <?php // echo $form->field($model, 'fecha_solic') ?>

    <?php // echo $form->field($model, 'fecha_pagado') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

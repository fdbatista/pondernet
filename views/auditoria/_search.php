<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\AuditoriaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auditoria-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'operacion') ?>
    
    <?= $form->field($model, 'autor') ?>

    <?= $form->field($model, 'producto') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'detalles') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

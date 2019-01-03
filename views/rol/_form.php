<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Rol */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rol-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    <div class="container">
    <?php
        $opciones = ArrayHelper::map($tipoOperaciones, 'id', 'nombre');
        /*foreach ($opciones as $opcion) {
            echo $form->field($model, 'operaciones[]')->checkbox(['label' => $opcion], true);
        }*/
        
        echo $form->field($model, 'operaciones')->checkboxList($opciones, ['unselect' => NULL, 'separator' => '<br />']);
    ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Agregar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

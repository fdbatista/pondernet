<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Categoria;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-form">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'id_padre')->dropDownList(ArrayHelper::map(Categoria::find()->all(), 'id', 'nombre'), ['prompt'=>'']) ?>
        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Agregar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>

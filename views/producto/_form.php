<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin([
         "method" => "post",
         "enableClientValidation" => true,
         "options" => ["enctype" => "multipart/form-data"],
         ]); ?>

    <?= $form->field($model, 'id_categoria')->dropDownList(ArrayHelper::map(app\models\Categoria::find()->all(), 'id', 'nombre')) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'precio')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'rebaja')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruta_imagen')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Agregar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

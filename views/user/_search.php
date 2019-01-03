<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'auth_key') ?>

    <?= $form->field($model, 'password_hash') ?>

    <?= $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'rol_id') ?>

    <?php // echo $form->field($model, 'nombre') ?>

    <?php // echo $form->field($model, 'apellidos') ?>

    <?php // echo $form->field($model, 'id_tipo_doc_id') ?>

    <?php // echo $form->field($model, 'num_doc_id') ?>

    <?php // echo $form->field($model, 'tel_movil') ?>

    <?php // echo $form->field($model, 'tel_fijo') ?>

    <?php // echo $form->field($model, 'skype') ?>

    <?php // echo $form->field($model, 'paypal') ?>

    <?php // echo $form->field($model, 'facebook') ?>

    <?php // echo $form->field($model, 'linkedin') ?>

    <?php // echo $form->field($model, 'twitter') ?>

    <?php // echo $form->field($model, 'youtube') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'codigo_postal') ?>

    <?php // echo $form->field($model, 'munic') ?>

    <?php // echo $form->field($model, 'prov') ?>

    <?php // echo $form->field($model, 'id_pais') ?>

    <?php // echo $form->field($model, 'referido_por') ?>

    <?php // echo $form->field($model, 'term_condic')->checkbox() ?>

    <?php // echo $form->field($model, 'id_nivel_acceso') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

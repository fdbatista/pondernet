<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = SiteController::translate('Update profile');
$this->params['breadcrumbs'][] = ['label' => SiteController::translate('Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => SiteController::translate('My profile'), 'url' => ['my-profile']];
$this->params['breadcrumbs'][] = SiteController::translate('Update');
?>
<div class="user-update">
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    <h3><?= SiteController::translate('Personal information') ?></h3>
    <div class="user-form">
    <?php $form = ActiveForm::begin(); ?>

        <div class="col-lg-6"><?= $form->field($model, 'username', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('username'), 'class' => 'form-control']])->label($model->getAttributeLabel('username'))->textInput(['maxlength' => true, 'disabled' => 'true']) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'email', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('email'), 'class' => 'form-control']])->label($model->getAttributeLabel('email')) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'rol_id')->dropDownList(ArrayHelper::map(app\models\Rol::find()->all(), 'id', 'nombre'), ['disabled' => 'true']) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'nombre', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('nombre'), 'class' => 'form-control']])->label($model->getAttributeLabel('nombre')) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'apellidos', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('apellidos'), 'class' => 'form-control']])->label($model->getAttributeLabel('apellidos')) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'id_tipo_doc_id')->dropDownList(ArrayHelper::map(app\models\TipoDocId::find()->all(),'id','nombre'), ['prompt'=>$model->getAttributeLabel('id_tipo_doc_id')])->label($model->getAttributeLabel('id_tipo_doc_id')) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'num_doc_id', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('num_doc_id'), 'class' => 'form-control']])->label($model->getAttributeLabel('num_doc_id')) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'tel_movil', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('tel_movil'), 'class' => 'form-control']])->label($model->getAttributeLabel('tel_movil')) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'tel_fijo', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('tel_fijo'), 'class' => 'form-control']])->label($model->getAttributeLabel('tel_fijo')) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'skype', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('skype'), 'class' => 'form-control']])->label($model->getAttributeLabel('skype')) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'paypal', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('paypal'), 'class' => 'form-control']])->label($model->getAttributeLabel('paypal')) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'facebook', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('facebook'), 'class' => 'form-control']])->label($model->getAttributeLabel('facebook')) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'linkedin', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('linkedin'), 'class' => 'form-control']])->label($model->getAttributeLabel('linkedin')) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'twitter', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('twitter'), 'class' => 'form-control']])->label($model->getAttributeLabel('twitter')) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'youtube', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('youtube'), 'class' => 'form-control']])->label($model->getAttributeLabel('youtube')) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'direccion', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('direccion'), 'class' => 'form-control']])->label($model->getAttributeLabel('direccion')) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'codigo_postal', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('codigo_postal'), 'class' => 'form-control']])->label($model->getAttributeLabel('codigo_postal')) ?></div>
        

        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-3" style="margin-right: 100px;"><?= $form->field($model, 'prov', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('prov'), 'class' => 'form-control typeahead typeahead-prov']])->label($model->getAttributeLabel('prov')) ?></div>
                <div class="col-lg-3"><?= $form->field($model, 'munic', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('munic'), 'class' => 'form-control typeahead typeahead-munic']])->label($model->getAttributeLabel('munic')) ?></div>
            </div>
        </div>
        
    <div class="form-group">
        <?= Html::submitButton(SiteController::translate('Accept'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


</div>

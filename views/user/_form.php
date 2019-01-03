<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Pais;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<!--<div class="user-form">-->
<div class="row">
    
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-6"><?= $form->field($model, 'username', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('username'), 'class' => 'form-control']])->textInput(['maxlength' => true, 'disabled' => 'true']) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'email', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('email'), 'class' => 'form-control']]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'rol_id')->dropDownList(ArrayHelper::map(app\models\Rol::find()->all(), 'id', 'nombre'), ['disabled' => 'true']) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'nombre', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('nombre'), 'class' => 'form-control']]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'apellidos', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('apellidos'), 'class' => 'form-control']]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'id_tipo_doc_id')->dropDownList(ArrayHelper::map(app\models\TipoDocId::find()->all(),'id','nombre'), ['prompt'=>$model->getAttributeLabel('id_tipo_doc_id')]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'num_doc_id', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('num_doc_id'), 'class' => 'form-control']]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'tel_movil', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('tel_movil'), 'class' => 'form-control']]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'tel_fijo', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('tel_fijo'), 'class' => 'form-control']]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'skype', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('skype'), 'class' => 'form-control']]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'paypal', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('paypal'), 'class' => 'form-control']]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'facebook', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('facebook'), 'class' => 'form-control']]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'linkedin', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('linkedin'), 'class' => 'form-control']]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'twitter', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('twitter'), 'class' => 'form-control']]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'youtube', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('youtube'), 'class' => 'form-control']]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'direccion', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('direccion'), 'class' => 'form-control']]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'codigo_postal', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('codigo_postal'), 'class' => 'form-control']]) ?></div>
        
        <div class="col-lg-6">
            <?php
            $paises = ArrayHelper::map(Pais::find()->all(), 'id', 'nombre');
            echo $form->field($model, 'id_pais')->dropDownList(
                $paises,
                [
                    'prompt' => $model->getAttributeLabel('id_pais'),
                    /*'onchange' => '
                        $.get( "'.Url::toRoute('dependent-dropdown/provincia').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'id_prov').'" ).html( data );
                                $( "#'.Html::getInputId($model, 'id_munic').'" ).html( null );
                            }
                        );
                    '*/
                ]
            );
            ?>
        </div>

        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-3" style="margin-right: 100px;"><?= $form->field($model, 'prov', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('prov'), 'class' => 'form-control typeahead typeahead-prov']])->label($model->getAttributeLabel('prov')) ?></div>
                <div class="col-lg-3"><?= $form->field($model, 'munic', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('munic'), 'class' => 'form-control typeahead typeahead-munic']])->label($model->getAttributeLabel('munic')) ?></div>
            </div>
        </div>
        <div class="col-lg-6"><?= $form->field($model, 'intentos_cnx_fallidos')->textInput() ?></div>
        
    </div>
    <div class="col-lg-6">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Agregar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

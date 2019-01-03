<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Pais;
use app\models\User;
use app\controllers\SiteController;

$this->title = SiteController::translate('Signup');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= SiteController::translate('Please fill out the following form to signup:') ?></p>

    <div class="row">
        <div class="col-lg-12">
            
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                
                <div class="col-lg-6"><?= $form->field($model, 'username', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('username'), 'class' => 'form-control']])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'email', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('email'), 'class' => 'form-control']])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'password', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('password'), 'class' => 'form-control']])->passwordInput()->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'confirmation', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('confirmation'), 'class' => 'form-control']])->passwordInput()->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'nombre', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('nombre'), 'class' => 'form-control']])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'apellidos', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('apellidos'), 'class' => 'form-control']])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'id_tipo_doc_id')->dropDownList(ArrayHelper::map(app\models\TipoDocId::find()->all(),'id','nombre'), ['prompt'=>$model->getAttributeLabel('id_tipo_doc_id')])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'num_doc_id', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('num_doc_id'), 'class' => 'form-control']])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'tel_movil', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('tel_movil'), 'class' => 'form-control']])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'tel_fijo', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('tel_fijo'), 'class' => 'form-control']])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'skype', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('skype'), 'class' => 'form-control']])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'paypal', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('paypal'), 'class' => 'form-control']])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'facebook', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('facebook'), 'class' => 'form-control']])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'linkedin', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('linkedin'), 'class' => 'form-control']])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'twitter', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('twitter'), 'class' => 'form-control']])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'youtube', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('youtube'), 'class' => 'form-control']])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'direccion', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('direccion'), 'class' => 'form-control']])->label(false) ?></div>
                <div class="col-lg-6"><?= $form->field($model, 'codigo_postal', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('codigo_postal'), 'class' => 'form-control']])->label(false) ?></div>

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
                    )->label(false);
                    ?>
                </div>
                
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-3" style="margin-right: 100px;"><?= $form->field($model, 'prov', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('prov'), 'class' => 'form-control typeahead typeahead-prov']])->label(false) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'munic', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('munic'), 'class' => 'form-control typeahead typeahead-munic']])->label(false) ?></div>
                    </div>
                </div>
                
                <div class="col-lg-6"></div>
                <div class="col-lg-6"><?= (isset($referente)) ? $form->field($model, 'referido_por', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('username'), 'class' => 'form-control']])->dropDownList($referente, ['disabled' => true]) : /*$form->field($model, 'referido_por')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'email'), ['prompt' => ''])->label(false)*/ null ?></div>
                <div class="col-lg-6"><?= (isset($curso)) ? $form->field($model, 'id_curso', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('username'), 'class' => 'form-control']])->dropDownList($curso, ['disabled' => true])->label(false) : null ?></div>            
                
                <div class="col-lg-12"><?= $form->field($model, 'term_condic')->checkbox() ?></div>
                <div class="col-lg-12"><?= Html::submitButton(SiteController::translate('Submit'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?></div>
            <?php ActiveForm::end(); ?>
        
        </div>
    </div>
</div>



    


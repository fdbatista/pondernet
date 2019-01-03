<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\controllers\SiteController;
use yii\bootstrap\ActiveForm;

$this->title = SiteController::translate('My Office');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    <h2><?= Html::encode($this->title) ?></h2>
    <div class="container">
        <?= SiteController::translate('Affiliate link: ') ?> <code><?= Html::a(Url::home(true) . "site/usuario/" . Yii::$app->user->identity->username /*. 'site/usuario/' . Yii::$app->user->identity->username*/, Url::toRoute(['site/usuario', 'id' => Yii::$app->user->identity->username])) ?></code><br/><br/>
        <?= SiteController::translate('Invitation link: ') ?> <code><?= Html::a(Url::home(true) . "site/signup?referente=" . Yii::$app->user->identity->username /*. 'site/usuario/' . Yii::$app->user->identity->username*/, Url::toRoute(['site/signup', 'referente' => Yii::$app->user->identity->username])) ?></code>
    </div>
</div>

<div class="site-contact" style="margin-top: 30px;">
    <h3><?= SiteController::translate('Sending invitations') ?></h3>
    <div class="row">
        <div class="container">
            <?php $form = ActiveForm::begin([
                "method" => "post",
                "enableClientValidation" => true,
                "action" => ["site/invitar"]
             ]); ?>
            <div class="col-lg-3"><?= $form->field($modelInvitar, 'tipo_invitacion')->radioList([SiteController::translate('Join our site'), SiteController::translate('Buy a course')], ['id' => 'radio-tipo-invitacion']) ?></div>
            <div class="col-lg-3"><?= $form->field($modelInvitar, 'destinatario')->textInput(['placeholder' => SiteController::translate('Email')]) ?></div>
            <div class="col-lg-3" id="div-invitacion-curso"><?= $form->field($modelInvitar, 'id_curso')->dropDownList(\yii\helpers\ArrayHelper::map(app\models\Producto::find()->all(),'id','nombre'), ['prompt'=>'']) ?></div>
            <div class="col-lg-3">
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary btn-lg" data-confirm="<?= SiteController::translate('Are you sure you want to continue?') ?>"><i class="n-icon glyphicon n-icon-invitation"></i>&nbsp;&nbsp;<?= SiteController::translate('Submit') ?></button>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="container" style="margin-top: 30px;">
            <h3><?= SiteController::translate('My boxes') ?></h3><br />
        </div>
        <div>
            <div class="col-lg-12">
                <div class="col-lg-3">
                    <p class="encab-caja-ofic"><?= SiteController::translate('Box ') ?>1</p>
                    <?php
                        if (isset($cajas[0]))
                        {
                            foreach ($cajas[0] as $pos => $caja)
                            {
                                $idAux = $caja['ID_INVITADO'] == 0 ? $caja['ID_USUARIO'] : $caja['ID_INVITADO'];
                                ?>
                                <p><?= $pos + 1 ?>. <a href="<?= Url::toRoute(['site/usuario', 'id' => $idAux]) ?>" data-placement="right" title="<?= app\controllers\HoverController::hoverCard($idAux) ?>" data-toggle="tooltip"><?= $caja['INVITADO'] ?></a></p>
                            <?php
                            }
                        }
                    ?>
                </div>
                <div class="col-lg-3">
                    <p class="encab-caja-ofic"><?= SiteController::translate('Box ') ?>2</p>
                    <?php
                        if (isset($cajas[1]))
                        {
                            foreach ($cajas[1] as $caja)
                            {?>
                                <p><a><?= $caja['INVITADO'] ?></a></p>
                            <?php
                            }
                        }
                    ?>
                </div>
                <div class="col-lg-3">
                    <p class="encab-caja-ofic"><?= SiteController::translate('Box ') ?>3</p>
                    <?php
                        if (isset($cajas[2]))
                        {
                            foreach ($cajas[2] as $pos => $caja)
                            {?>
                                <p><a><?= $pos . '. ' . $caja['INVITADO'] ?></a></p>
                            <?php
                            }
                        }
                    ?>
                </div>
                <div class="col-lg-3">
                    <p class="encab-caja-ofic"><?= SiteController::translate('Box ') ?>4</p>
                    <?php
                        if (isset($cajas[3]))
                        {
                            foreach ($cajas[3] as $caja)
                            {?>
                                <p><a><?= $caja['INVITADO'] ?></a></p>
                            <?php
                            }
                        }
                    ?>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="container" style="margin-top: 30px;">
            
            <h3><?= SiteController::translate('My bought courses') ?></h3><br />
            <?= GridView::widget([
                'dataProvider' => $comprasDataProvider,
                'filterModel' => [],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => SiteController::translate('Course'),
                        'format' => 'raw',
                        'value' => function ($data)
                        {
                            return Html::a($data->producto->nombre, yii\helpers\Url::toRoute(['producto/view', 'id' => $data->producto->id]));
                        },
                    ],
                ],
            ]); ?>
            
            <h3><?= SiteController::translate('My sold courses') ?></h3><br />
            <?= GridView::widget([
                'dataProvider' => $ventasDataProvider,
                'filterModel' => [],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => SiteController::translate('Buyer'),
                        'format' => 'raw',
                        'value' => function ($data)
                        {
                            return Html::a($data->user->nombre . ' ' . $data->user->apellidos, yii\helpers\Url::toRoute(['site/usuario', 'id' => $data->user->username]), ['data-placement' => 'right', 'title' => app\controllers\HoverController::hoverCard($data->id_usuario), 'data-toggle' => 'tooltip']);
                        },
                    ],
                    [
                        'attribute' => SiteController::translate('Course'),
                        'format' => 'raw',
                        'value' => function ($data)
                        {
                            return Html::a($data->producto->nombre, yii\helpers\Url::toRoute(['producto/view', 'id' => $data->producto->id]));
                        },
                    ],
                ],
            ]); ?>
            
        </div>
        
        <div class="container">
            <br /><br />
            <table class="table table-striped table-bordered">
                <tr>
                    <td style="text-align: center"><h3><?= SiteController::translate('My wallet') ?></h3></td>
                </tr>
            </table>
            
            <div class="col-lg-4" style="margin-bottom: 5px;"><b>Total de comisiones no solicitadas: </b><code><?= $comisiones['solicitables_venta_directa'] + $comisiones['solicitables_circuito'] ?>&euro;</code></div>
            
            <div class="col-lg-4" style="margin-bottom: 5px;">
                <b>Por venta directa: </b><code><?= $comisiones['solicitables_venta_directa'] ?>&euro;</code><br />
                <?php
                    if ($comisiones['solicitables_venta_directa'] > 49)
                    {
                    ?>
                        <button style="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmar-cobro-comisiones"><i class="n-icon glyphicon n-icon-euro"></i><?= SiteController::translate('Quick Start Bonus') ?></button>  
                    <?php
                    }
                ?>
            </div>
            <div class="col-lg-4" style="margin-bottom: 5px;">
                <b>Por circuitos completados: </b><code><?= $comisiones['solicitables_circuito'] ?>&euro;</code><br />
                <?php
                    if ($comisiones['solicitables_circuito'] == 3000)
                    {
                    ?>
                        <button style="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmar-retiro-fondos"><i class="n-icon glyphicon n-icon-euro"></i><?= SiteController::translate('Retire funds') ?></button>
                    <?php
                    }
                ?>
            </div>
        </div>
        
        <div class="container">
            <br /><br />
            <table class="table table-striped table-bordered">
                <tr>
                    <td style="text-align: center"><h3><?= SiteController::translate('Financial history') ?></h3></td>
                </tr>
            </table>
            
            <div class="col-lg-4" style="margin-bottom: 5px;"><b>Total de comisiones pagadas: </b><code><?= $comisiones['efect_venta_directa'] + $comisiones['efect_circuito'] ?>&euro;</code></div>
            
            <div class="col-lg-4" style="margin-bottom: 5px;">
                <b>Por venta directa: </b><code><?= $comisiones['efect_venta_directa'] ?>&euro;</code><br />
            </div>
            <div class="col-lg-4" style="margin-bottom: 5px;">
                <b>Por circuitos completados: </b><code><?= $comisiones['efect_circuito'] ?>&euro;</code><br />
            </div>
            <hr />
            
            <div class="col-lg-4" style="margin-bottom: 5px;"><b>Total de comisiones solicitadas (por pagar): </b><code><?= $comisiones['pend_venta_directa'] + $comisiones['pend_circuito'] ?>&euro;</code></div>
            
            <div class="col-lg-4" style="margin-bottom: 5px;">
                <b>Por venta directa: </b><code><?= $comisiones['pend_venta_directa'] ?>&euro;</code><br />
            </div>
            <div class="col-lg-4" style="margin-bottom: 5px;">
                <b>Por circuitos completados: </b><code><?= $comisiones['pend_circuito'] ?>&euro;</code><br />
            </div>
            
        </div>
        
        <br />
        <div class="container">
            <table class="table table-striped table-bordered">
                <tr>
                    <td style="text-align: center"><h3><?= SiteController::translate('My payments') ?></h3></td>
                </tr>
            </table>
            <?= GridView::widget([
                'dataProvider' => $pagosDataProvider,
                'filterModel' => [],
                'columns' => [
                    [
                        'attribute' => SiteController::translate('Request date'),
                        'format' => 'raw',
                        'value' => function ($data)
                        {
                            return $data->fecha_solic;
                        },
                    ],
                    [
                        'attribute' => SiteController::translate('Credit'),
                        'format' => 'raw',
                        'value' => function ($data)
                        {
                            return $data->cantidad . '€';
                        },
                    ],
                    [
                        'attribute' => 'IVA',
                        'format' => 'raw',
                        'value' => function ($data)
                        {
                            return '0.00€';
                        },
                    ],
                    [
                        'attribute' => 'Total',
                        'format' => 'raw',
                        'value' => function ($data)
                        {
                            return $data->cantidad . '€';
                        },
                    ],
                    [
                        'attribute' => SiteController::translate('Payment date'),
                        'format' => 'raw',
                        'value' => function ($data)
                        {
                            return $data->fecha_pagado;
                        },
                    ],
                    [
                        'attribute' => SiteController::translate('Status'),
                        'format' => 'raw',
                        'value' => function ($data)
                        {
                            return $data->pagado == 1 ? SiteController::translate('Payed') : SiteController::translate('Pending');
                        },
                    ],
                    
                ],
            ]); ?>
        </div>
    </div>

</div>

<div class="row">
    
    <div style="display: none;" id="confirmar-retiro-fondos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="gridModalLabel"><?= SiteController::translate('Retire funds') ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12"><?= SiteController::translate('Are you sure you want to retire your uncollected funds?') ?></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmar-circuito" data-dismiss="modal"><?= SiteController::translate('Yes') ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= SiteController::translate('No') ?></button>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none;" id="confirmar-circuito" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="gridModalLabel"><?= SiteController::translate('Stay in PonderNET') ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12"><?= SiteController::translate('Do you wish to stay on the continuous training plan and generate another 3000€?') ?></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= Url::toRoute(['site/retirar-fondos', 'seguir' => '1']) ?>" class="btn btn-primary btn-lg" style="background-color: #0088e4;" ><?= SiteController::translate('Yes') ?></a>
                    <a href="<?= Url::toRoute(['site/retirar-fondos', 'seguir' => '0']) ?>" class="btn btn-danger btn-lg" ><?= SiteController::translate('No') ?></a>
                </div>
            </div>
        </div>
    </div>
    
    <div style="display: none;" id="confirmar-cobro-comisiones" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="gridModalLabel"><?= SiteController::translate('Quick Start Bonus') ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12"><?= SiteController::translate('Do you wish to retire this guick start bonus?') ?></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= Url::toRoute(['site/cobrar-comisiones']) ?>" class="btn btn-primary btn-lg" style="background-color: #0088e4;" ><?= SiteController::translate('Yes') ?></a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?= SiteController::translate('No') ?></button>
                </div>
            </div>
        </div>
    </div>
    
</div>
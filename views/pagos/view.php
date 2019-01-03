<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pagos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pagos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_usuario',
            'cantidad',
            [
                'attribute' => 'tipo',
                'value' => $model->tipo == 1 ? 'Venta directa' : 'Circuito completado',
            ],
            'pagado:boolean',
            [
                'attribute' => 'pagado_por',
                'value' => $model->pagado_por ? $model->pagadoPor->username : '',
            ],
            'fecha_solic',
            'fecha_pagado',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PagosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pagos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'id_usuario',
                'value' => 'idUsuario.username',
            ],
            'cantidad',
            [
                'attribute' => 'tipo',
                'value' => function ($data) {
                    return $data->tipo == 1 ? 'Venta directa' : 'Circuito completado';
                }
            ],
            'pagado:boolean',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}'
            ],
        ],
    ]); ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = SiteController::translate('Available courses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'categoria',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a($data->categoria->nombre, yii\helpers\Url::toRoute(['categoria/view', 'id' => $data->categoria->id]));
                }
            ],
            [
                'attribute' => 'nombre',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a($data->nombre, yii\helpers\Url::toRoute(['producto/view', 'id' => $data->id]));
                }
            ],
            'descripcion',
            /*[
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],*/
        ],
    ]); ?>

</div>

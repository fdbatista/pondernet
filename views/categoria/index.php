<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = SiteController::translate('Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        //echo $this->render('_search', ['model' => $searchModel]);
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'nombre',
                'format' => 'raw',
                'value' => function ($data)
                {
                    return Html::a($data->nombre, yii\helpers\Url::toRoute(['categoria/view', 'id' => $data->id]));
                },
            ],
            'descripcion'
        ],
        ]);
    ?>
   

</div>


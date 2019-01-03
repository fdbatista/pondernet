<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cursos');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['admin']];
?>
<div class="producto-index">
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Adicionar curso'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'nombre',
            'descripcion',
            [
                'attribute' => 'categoria',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a($data->categoria->nombre, yii\helpers\Url::toRoute(['categoria/update', 'id' => $data->categoria->id]));
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete} {admin}',
                'buttons' =>
                [
                    'admin' => function ($url, $model, $key)
                    {
                        return '<a title="Gestionar ficheros" href="' . yii\helpers\Url::toRoute(['producto/gestionar-ficheros', 'id' => $model->id]) . '"><i class = "fa fa-files-o"></i></a>';
                    },
                ]
            ],
        ],
    ]); ?>

</div>

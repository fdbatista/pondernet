<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'nombre',
            'apellidos',
            'email:email',
            'status',
            [
                'label' => 'Rol',
                'value' => 'rol.nombre'
            ],
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                /*'buttons' =>
                [
                    'delete' => function ($url, $model, $key)
                    {
                        return '<a method="post" title="Eliminar" data-confirm="Seguro?" href="' . yii\helpers\Url::toRoute(['user/delete', 'id' => $model->id], ['method' => 'post']) . '"><span class = "glyphicon glyphicon-trash"></span></a>';
                    },
                ]*/
            ],
        ],
    ]); ?>

</div>

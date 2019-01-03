<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */

$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'categoría',
]) . ' ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Categorías', 'url' => ['admin']];
$this->params['breadcrumbs'][] = ['label' => 'Actualizar', 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => $model->id];

?>
<div class="categoria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

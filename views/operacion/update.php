<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Operacion */

$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'operación',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="operacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

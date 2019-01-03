<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppConfig */

$this->title = 'Modificar';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Opciones generales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modificar');
?>
<div class="app-config-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

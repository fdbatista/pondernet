<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rol */

$this->title = Yii::t('app', 'Crear Rol');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', ['model' => $model, 'tipoOperaciones' => $tipoOperaciones]) ?>
</div>

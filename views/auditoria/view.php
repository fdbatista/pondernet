<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Auditoria */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auditoría'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auditoria-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'operacion',
            'autor',
            'producto',
            'fecha',
            'ip',
            'detalles',
        ],
    ]) ?>

</div>

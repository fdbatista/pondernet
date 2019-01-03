<?php

use yii\helpers\Url;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => SiteController::translate('Courses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['producto/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => SiteController::translate('Buy'), 'url' => ['producto/comprar', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => SiteController::translate('Process completed')];
?>

<div class="producto-view">
    <h3><?= SiteController::translate('Thanks for buying this course!') ?></h3>
    <h4><?= SiteController::translate('Now you can download its files from ') ?> <a href="<?= Url::toRoute(['producto/view', 'id' => $model->id]) ?>">here</a></h4>
</div>

<div class="producto-view">
    
    
    
</div>
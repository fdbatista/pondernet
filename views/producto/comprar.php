<?php

use yii\helpers\Html;
//use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => SiteController::translate('Courses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['producto/view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = ['label' => SiteController::translate('Buy'), 'url' => ['producto/simular-compra', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => SiteController::translate('Buy'), 'url' => ['producto/comprar', 'id' => $model->id]];
?>

<div class="producto-view">
    <h3> <?= SiteController::translate('Buy course') ?> &raquo; <?= Html::encode($this->title) ?></h3>
</div>

<div class="producto-view">
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    <?= Html::beginForm('https://www.paypal.com/cgi-bin/webscr', "post") ?>
    <!--<?= Html::beginForm(['producto/simular-compra', 'id' => $model->id], "post") ?>-->
        
        <?= Html::input("hidden", "cmd", "_xclick") ?>
        <?= Html::input("hidden", "business", "paypal@pondernet.com") ?>
        <?= Html::input("hidden", "item_name", $model->nombre) ?>
        <?= Html::input("hidden", "item_number", $model->id) ?>
        <?= Html::input("hidden", "currency_code", "EUR") ?>
        <?= Html::input("hidden", "no_note", "1") ?>
        <?= Html::input("hidden", "no_shipping", "1") ?>
        <?= Html::input("hidden", "amount", ($model->rebaja) ? $model->rebaja : $model->precio) ?>
        <?= Html::input("hidden", "return", Url::toRoute(['producto/gracias'])) ?>
        <?= Html::input("hidden", "cancel_return", Url::toRoute(['producto/comprar', 'id' => $model->id])) ?>
        <?= Html::input("hidden", "notify_url", Url::toRoute(['producto/confirmar-compra', 'id' => $model->id])) ?>
        <?= Html::input("submit", "", SiteController::translate('Confirm payment'), ['class' => 'btn btn-success']) ?>
        
    <?= Html::endForm() ?>
    
</div>
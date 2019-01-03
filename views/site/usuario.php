<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => SiteController::translate('Office'), 'url' => ['site/oficina']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    <h1><?= SiteController::translate('User details for ') . Html::encode($this->title) ?></h1>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'nombre',
            'apellidos',
            'tel_movil',
            'tel_fijo',
            [
                'label' => SiteController::translate('Country'),
                'value' => $model->idPais->nombre
            ],
            'prov',
            'munic',
            [
                'label' => SiteController::translate('Role'),
                'value' => $model->rol->nombre
            ],
        ],
    ]) ?>

</div>

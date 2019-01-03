<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = SiteController::translate('My profile');
//$this->params['breadcrumbs'][] = ['label' => SiteController::translate('Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(SiteController::translate('Update'), ['update-profile'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            'nombre',
            'apellidos',
            [
                'label' => SiteController::translate('Identification document'),
                'value' => $model->idTipoDoc->nombre
            ],
            'num_doc_id',
            'tel_movil',
            'tel_fijo',
            'skype',
            'paypal',
            'facebook',
            'linkedin',
            'twitter',
            'youtube',
            'direccion',
            'codigo_postal',
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
            [
                'label' => SiteController::translate('Created at'),
                'value' => date('d/m/y', $model->created_at)
            ],
        ],
    ]) ?>

</div>

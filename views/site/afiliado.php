<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = SiteController::translate('My profile');
//$this->params['breadcrumbs'][] = ['label' => \app\controllers\SiteController::translate('Users'), 'url' => ['index']];
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
            [
                'label' => SiteController::translate('Status'),
                'value' => ($model->status == 0) ? SiteController::translate('Inactive') : ($model->status == 2) ? SiteController::translate('Blocked') : SiteController::translate('Active')
            ],
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
            [
                'label' => SiteController::translate('Province'),
                'value' => (isset($model->idProv)) ? $model->idProv->nombre : NULL
            ],
            [
                'label' => SiteController::translate('Municipality'),
                'value' => (isset($model->idMunic)) ? $model->idMunic->nombre : NULL
            ],
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

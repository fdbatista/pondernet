<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Mi Perfil');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update-profile'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            [
                'label' => 'Estado',
                'value' => ($model->status != 0) ? 'Activo' : 'Inactivo'
            ],
            'nombre',
            'apellidos',
            [
                'label' => 'Tipo de documento',
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
                'label' => 'País',
                'value' => $model->idPais->nombre
            ],
            [
                'label' => 'Provincia',
                'value' => $model->idProv->nombre
            ],
            [
                'label' => 'Municipio',
                'value' => $model->idMunic->nombre
            ],
            [
                'label' => 'Rol',
                'value' => $model->rol->nombre
            ],
            [
                'label' => 'Creado el',
                'value' => date('d/m/y', $model->created_at)
            ],
        ],
    ]) ?>

</div>

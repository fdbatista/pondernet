<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        $miPerfil = ($model->id == Yii::$app->user->id ? " hidden" : "");
    ?>
    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->id], [
            'class' => "btn btn-danger $miPerfil",
            'data' => [
                'confirm' => Yii::t('app', '¿Confirma que desea eliminar este elemento?'),
                'method' => 'post',
            ],
        ]) ?>
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
                'value' => (isset($model->idProv)) ? $model->idProv->nombre : NULL
            ],
            [
                'label' => 'Municipio',
                'value' => (isset($model->idMunic)) ? $model->idMunic->nombre : NULL
            ],
            [
                'label' => 'Rol',
                'value' => $model->rol->nombre
            ],
            [
                'label' => 'Creado el',
                'value' => date('d/m/y', $model->created_at)
            ],
            [
                'label' => 'Datos modificados el',
                'value' => date('d/m/y', $model->updated_at)
            ],
        ],
    ]) ?>

</div>

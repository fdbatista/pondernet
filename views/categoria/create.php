<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Categoria */

$this->title = Yii::t('app', 'Crear categoría');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorías'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

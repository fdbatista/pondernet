<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => SiteController::translate('Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => SiteController::translate('Category'),
                'value' => (isset($model->padre->nombre)) ? $model->padre->nombre : '',
            ],
            'nombre',
            'descripcion:ntext',
        ],
    ]) ?>

</div>

<h3><?= SiteController::translate('Courses') ?></h3>

<div class="row">
    
    <?php
    foreach ($cursos as $curso)
    {?>
        <div class="col-lg-4">
            <div class="home-category__cell home-category--programming" style="width: 100%" href="#">
                <div class="category__mobile">
                    <i class="icon"></i>
                </div>
                <div>
                    <div class="card">
                        <div class="card-image">
                            <div class="card-image__content">
                                <p class="card-image__text"><?= substr($curso->descripcion, 0, 75) . '...' ?></p>
                                <a class="card-image__button btn btn-lg btn-orange" href="<?= Url::toRoute(['producto/view', 'id' => $curso->id]) ?>"><?= SiteController::translate('Details') ?> &raquo;</a>
                            </div>
                        </div>
                        <div class="card-content">
                            <div>
                                <div><h4 class="card-title"><?= substr($curso->nombre, 0, 32) . '...' ?></h4></div>
                                <div style="float: right"><p style="margin: 0 10px 10px 0; color: #0088e4; font-size: 18px; margin-bottom: 10px;"><?= $curso->precio ?>&euro;</p></div>
                            </div>
                            <p class="card-text badge"><?= $curso->categoria->nombre ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    
</div>
<br />
<?= LinkPager::widget(['pagination' => $pagination]); ?>
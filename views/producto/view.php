<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => SiteController::translate('Courses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['producto/view', 'id' => $model->id]];
?>

<div class="producto-view">
    
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>

    <h3><?= Html::encode($this->title) ?></h3>
    
    <p><?= ($puedeComprar) ? Html::a(SiteController::translate('Buy course'), ['producto/comprar', 'id' => $model->id], ['class' => 'btn btn-primary']) : null ?></p>
    
    
    <?php
        if (isset($imagenCurso))
        {
            echo '<img class="img-rounded" src="' . '/cursos/imagenes/' . $imagenCurso . '" style="height: 55px; margin-bottom: 3px;" />';
        }
    ?>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => SiteController::translate('Category'),
                'value' => $model->categoria->nombre
            ],
            'nombre',
            'descripcion',
        ],
    ]) ?>

</div>

<div class="producto-view">
    <h3><?= SiteController::translate('Uploaded files for this course') ?></h3>
</div>

<div class="content">
    <?php
        include ("assets/sitio/php/file-tree/php_file_tree.php");
        try
        {
            if (!$puedeComprar)
            {
                $ruta = Yii::$app->basePath . "\\web\\cursos\\$model->id";
                if (file_exists($ruta))
                    echo php_file_tree($ruta, $model->id);
                else
                {
                    echo '<h4>' . SiteController::translate('There are no files for this course yet.') . '</h4>';
                    Yii::$app->session->setFlash('danger', SiteController::translate('The main directory for this course does not exist.'));
                }
            }
            else
            {
                echo '<div class = "label label-danger">' . SiteController::translate('You haven\'t paid yet for this course.') . '</div>';
            }
        }
        catch (\Exception $exc)
        {
            if ($exc->getCode() == 2)
                echo '<h4>' . SiteController::translate('There are no files for this course yet.') . '</h4>';
            else
                echo "<h4>" . $exc->getMesage() . "</h4>";
        }

    ?>
</div>

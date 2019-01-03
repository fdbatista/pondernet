<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\CommonTasks;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = Yii::t('app', 'Administrar ficheros');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cursos'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Administrar ficheros'), 'url' => ['/producto/gestionar-ficheros', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => $model->nombre];

$dirs = explode("/", trim($ruta, '/'));
$urlAcumul = '';
foreach ($dirs as $dir)
{
    $urlAcumul .= "/$dir";
    $this->params['breadcrumbs'][] = ['label' => $dir, 'url' => ['/producto/gestionar-ficheros', 'id' => $model->id, 'ruta' => $urlAcumul]];
}
?>

<?= \app\controllers\StaticMembers::MostrarMensajes() ?>

<div class="producto-update">
    <h3>Ficheros del curso</h3>
</div>

<div class="content">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="width: 5%">#</th>
                <th>Nombre</th>
                <th style="width: 10%">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $contTotal = 1;
                $rutaSubirNivel = substr($ruta, 0, strrpos($ruta, '/'));
            ?>
            
            <tr><td></td><td><?= Html::img('/assets/sitio/imagenes/file-tree/directory.png', ['style' => 'margin-bottom: 3px;']) ?> <a href="<?=Url::toRoute(['producto/gestionar-ficheros', 'id' => $model->id, 'ruta' => "$rutaSubirNivel"])?>">..</a> </td><td> </td></tr>
                <?php
                if (isset($ficheros[0]))
                {
                    foreach ($ficheros[0] as $fichero)
                    {
                    ?>
                        <tr><td><?=$contTotal++?></td><td><?= Html::img('/assets/sitio/imagenes/file-tree/directory.png', ['style' => 'margin-bottom: 3px;']) ?> <a href="<?=Url::toRoute(['producto/gestionar-ficheros', 'id' => $model->id, 'ruta' => "$ruta/$fichero"])?>"><?=$fichero?></a> </td><td><a href="<?=Url::toRoute(['producto/eliminar-carpeta', 'curso' => $model->id, 'ruta' => $ruta, 'index' => $contTotal - 2])?>" title="Delete" aria-label="Delete" data-confirm="¿Confirma que desea eliminar este elemento?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a></td></tr>
                    <?php
                    }
                }
                $contFichero = 0;
                if (isset($ficheros[1]))
                {
                    foreach ($ficheros[1] as $fichero)
                    {
                        $ext = strtolower(substr($fichero, strrpos($fichero, ".") + 1));
                    ?>
                        <tr><td><?=$contTotal++?></td><td><?= Html::img('/assets/sitio/imagenes/file-tree/' . CommonTasks::getExtensionIcono($ext) . '.png', ['style' => 'margin-bottom: 3px;']) ?> <?=$fichero?></td><td><a href="<?=Url::toRoute(['producto/eliminar-fichero', 'curso' => $model->id, 'ruta' => $ruta, 'index' => $contFichero++])?>" title="Delete" aria-label="Delete" data-confirm="¿Confirma que desea eliminar este elemento?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a></td></tr>
                    <?php
                    }
                }?>
        </tbody>
    </table>
</div>

<br/>
<div class="producto-update">
    
    <?php $form = ActiveForm::begin([
        "method" => "post",
        "enableClientValidation" => true,
        "action" => Url::toRoute('producto/crear-carpeta'),
        "id" => "formNuevaCarpeta",
        ]);
    ?>
        <input id="curso" name="curso" type="hidden" value="<?=$model->id?>" />
        <input id="ruta" name="ruta" type="hidden" value="<?=$ruta?>" />
        <div class="row">
            <div class="col-lg-3">
                <input class="form-control" type="text" id="txtNuevaCarpeta" name="txtNuevaCarpeta" placeholder="Nueva carpeta" maxlength="64" />
            </div>
            <div class="col-lg-3">
                <a class="btn btn-primary" href="javascript:enviarFormNuevaCarpeta()">Crear carpeta</a>
            </div>
        </div>
        
    <?php ActiveForm::end(); ?>
    
</div>

<br/>
<hr/>
<div class="producto-update">
    <h3>Agregar ficheros</h3>
    <div class="producto-form">

        <?php $form = ActiveForm::begin([
             "method" => "post",
             "enableClientValidation" => true,
             "options" => ["enctype" => "multipart/form-data"],
             "action" => Url::toRoute(['producto/gestionar-ficheros', 'id' => $model->id, 'ruta' => $ruta])
        ]); ?>

        <?= $form->field($modelUpload, 'someFile')->fileInput() ?>
        
        <div class="form-group">
            <!--<button formmethod="POST" class="btn btn-primary" onclick="index.php/?r=producto/gestionar-ficheros&id=<?=$model->id?>">Subir</button>-->
            <?= Html::submitButton(Yii::t('app', 'Enviar fichero'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

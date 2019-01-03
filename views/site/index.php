<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use app\controllers\SiteController;

$this->title = Yii::$app->name;
?>

<div class="container">
    <div class="col-lg-12">
        
        <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div style="color: white; background: url('/assets/sitio/imagenes/carousel/red.jpg') no-repeat; height: 260px; padding: 20px;">
                        <h3 style=""><?= SiteController::translate('Welcome to PonderNet!') ?></h3>
                        <h4 style="margin-top: 130px;"><?= SiteController::translate('A new Online Education WebSite') ?></h4>
                    </div>
                </div>

                <div class="item">
                    <div style="color: white; background: url('/assets/sitio/imagenes/carousel/purple.jpg') no-repeat; height: 260px; padding: 20px;">
                        <h3 style=""><?= SiteController::translate('Categories') ?></h3>
                        <h4 style="margin-top: 130px;"><?= SiteController::translate('Watch our product categories to access all products') ?></h4>
                    </div>
                </div>
                
                <div class="item">
                    <div style="color: white; background: url('/assets/sitio/imagenes/carousel/blue.jpg') no-repeat; height: 260px; padding: 20px;">
                        <h3 style=""><?= SiteController::translate('Courses') ?></h3>
                        <h4 style="margin-top: 130px;"><?= SiteController::translate('Knowledge is just one clic away from you') ?></h4>
                    </div>
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

<div class="container">
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
                        <div class="card-content" style="padding-bottom: 20px;">
                            <div>
                                <div><h4 class="card-title"><?= substr($curso->nombre, 0, 32) . '...' ?></h4></div>
                                <div style="float: right"><p style="margin: 0 10px 10px 0; color: #0088e4; font-size: 18px; margin-bottom: 10px;"><?= $curso->precio ?>&euro;</p></div>
                            </div>
                            <div>
                                <p class="card-text badge"><?= $curso->categoria->nombre ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

</div>

<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\controllers\SiteController;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="/assets/sitio/imagenes/varias/icono_app.png" rel="shortcut icon" type="image/x-icon">
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div class="wrap">
    <?php NavBar::begin([]); ?>
    <?php NavBar::end(); ?>
    
    <div class="navbar header no-margin navbar-fixed-top">
        <div class="container">
            
            <div class="navbar-header">
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="sr-only">M</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div style="background-image: url('/assets/sitio/imagenes/varias/logo.png'); width: 171px; height: 80px;">
                    <a href="<?= Yii::$app->homeUrl ?>" class="navbar-brand">
                        <?= Html::img('/assets/sitio/imagenes/varias/logo_vacio.png', ['alt' => 'PonderNET', 'style' => 'margin-top: -20px;']) ?>
                    </a>
                    <div style="width: 60%; float: right;">
                        <p style="text-align: right; font-size: 80%; line-height: 1;"><?= SiteController::translate('A new Online Education Website') ?></p>
                    </div>
                </div>
            </div>
            
            <div class="cart-block">
                <div class="cart-info">
                    <a href="#" class="cart-info-count"><?= SiteController::translate('Language') ?></a>
                </div>
                <i class="fa fa-globe"></i>
                
                <div class="cart-content-wrapper">
                    <div class="cart-content" style="width: 55%; float: right">
                        <ul class="scroller">
                            <li>
                                <table>
                                    <tr>
                                        <td><strong style="margin-top: -7px;"><a href="<?= Url::toRoute(['/site/change-language', 'language' => 'en-US', 'url' => Url::current()]) ?>"><img style="margin-top: -7px;" src="/assets/sitio/imagenes/banderas/en-US.png">English</a></strong></td>
                                    </tr>
                                </table>
                            </li>
                            <li>
                                <table>
                                    <tr>
                                        <td><strong style="margin-top: -7px;"><a href="<?= Url::toRoute(['/site/change-language', 'language' => 'es-ES', 'url' => Url::current()]) ?>"><img style="margin-top: -7px;" src="/assets/sitio/imagenes/banderas/es-ES.png">Espa&ntilde;ol</a></strong></td>
                                    </tr>
                                </table>
                            </li>
                            <li>
                                <table>
                                    <tr>
                                        <td><strong style="margin-top: -7px;"><a href="<?= Url::toRoute(['/site/change-language', 'language' => 'fr-FR', 'url' => Url::current()]) ?>"><img style="margin-top: -7px;" src="/assets/sitio/imagenes/banderas/fr-FR.png">Français</a></strong></td>
                                    </tr>
                                </table>
                            </li>
                            <li>
                                <table>
                                    <tr>
                                        <td><strong style="margin-top: -7px;"><a href="<?= Url::toRoute(['/site/change-language', 'language' => 'pt-PT', 'url' => Url::current()]) ?>"><img style="margin-top: -7px;" src="/assets/sitio/imagenes/banderas/pt-PT.png">Portugu&ecirc;s </a></strong></td>
                                    </tr>
                                </table>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="collapse navbar-collapse mega-menu">
                <ul class="nav navbar-nav" style="margin-left: 20px;">
                    
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" data-delay="0" data-close-others="false" data-target="product-list.html" href="product-list.html">
                            <?= SiteController::translate('Categories') ?>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        
                        <ul class="dropdown-menu" aria-labelledby="mega-menu">
                            <li>
                                <div class="nav-content">
                                    <?php
                                    $categs = SiteController::getCategorias();
                                    foreach ($categs as $arrCateg)
                                    {?>
                                        <div class="nav-content-col">
                                        <ul>
                                            <li><a href="<?= Url::toRoute(['/categoria/view', 'id' => $arrCateg['ID_CATEGORIA']]) ?>"><?= $arrCateg['CATEGORIA'] ?></a></li>
                                        </ul>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    
                                    <div class="nav-content-col">
                                        <ul>
                                            <li><a href="<?= Url::toRoute(['/categoria/index']) ?>"><?= SiteController::translate('View all...') ?></a></li>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </li>
                        </ul>
                        
                    </li>
                    
                    <li><?= Html::a(SiteController::translate('Courses'), ['/producto/index']) ?></li>
                    
                    <li><?= Html::a(SiteController::translate('About'), ['/site/about']) ?></li>
                    
                    <li><?= Html::a(SiteController::translate('Contact'), ['/site/contact']) ?></li>
                    
                    <?php
                    if (!Yii::$app->user->isGuest)
                    {?>
                        <li><?= Html::a(SiteController::translate('Office'), ['site/oficina']) ?></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-delay="0" data-close-others="false" data-target="#" href="#">
                                <?= SiteController::translate('My account') ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"> <?= Yii::$app->user->identity->username ?></li>
                                <?php
                                    if (Yii::$app->user->identity->rol_id == 4)
                                    {?>
                                        <li><a href="<?= Url::toRoute(['/admin']) ?>"><?= SiteController::translate('Manage site') ?></a></li>
                                    <?php
                                    }
                                ?>
                                <li><a href="<?= Url::toRoute(['site/my-profile']) ?>"><?= SiteController::translate('My profile') ?></a></li>
                                <li><a href="<?= Url::toRoute(['site/change-password']) ?>"><?= SiteController::translate('Change password') ?></a></li>
                                <li><?= Html::a(SiteController::translate('Logout'), ['site/logout'], ['data-method' => 'post']) ?></li>
                            </ul>
                        </li>
                    <?php
                    }
                    else
                    {?>
                        <li><?= Html::a(SiteController::translate('Login'), ['site/login']) ?></li>
                        <li><?= Html::a(SiteController::translate('Signup'), ['site/signup']) ?></li>
                    <?php
                    }
                    ?>
                    
                </ul>
            </div>
            <!-- END NAVIGATION -->
        </div>
    </div>
    

    <div class="container">
        
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">
            &copy; <?= Yii::$app->name ?> <?= date('Y') ?>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        
        var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
          var matches, substringRegex;
          matches = [];
          substrRegex = new RegExp(q, 'i');

          $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
              matches.push(str);
            }
          });

          cb(matches);
        };
      };
      
      var paises = <?= \app\controllers\StaticMembers::CargarNomenclador("pais") ?>;
      var provs = <?= \app\controllers\StaticMembers::CargarNomenclador("prov") ?>;
      var munics = <?= \app\controllers\StaticMembers::CargarNomenclador("munic") ?>;

      $('.typeahead-pais').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      },
      {
        name: 'paises',
        source: substringMatcher(paises)
      });
      
      $('.typeahead-prov').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      },
      {
        name: 'provs',
        source: substringMatcher(provs)
      });
      
      $('.typeahead-munic').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      },
      {
        name: 'munics',
        source: substringMatcher(munics)
      });
        
    });
</script>

</body>
</html>
<?php $this->endPage() ?>

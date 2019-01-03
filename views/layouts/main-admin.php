<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAssetAdmin;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\models\AccessHelpers;

AppAssetAdmin::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="/assets/sitio/imagenes/varias/icono_app.png" rel="shortcut icon" type="image/x-icon">
    <?php $this->head(); ?>
    
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'PonderNET Administración',
        'brandUrl' => '/admin',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('app', 'Inicio'), 'url' => ['/admin']],
    ];
    if (Yii::$app->user->isGuest)
    {
        $menuItems[] = ['label' => Yii::t('app', 'Acceder'), 'url' => ['/site/login']];
    }
    else
    {
        $menuItems =
        [
            [
                'label' => 'Ir al sitio',
                'visible' => true,
                'url' => ['/site'],
            ],
            [
                'label' => Yii::t('app', 'Auditoría'),
                'visible' => AccessHelpers::getAcceso('auditoria/index'),
                'url' => ['/auditoria'],
            ],
            [
                'label' => Yii::t('app', 'Administrar'),
                'visible' => true,
                'items' => [
                    ['label' => Yii::t('app', 'Categorías'), 'url' => ['/categoria/admin'], 'visible' => AccessHelpers::getAcceso('categoria/index')],
                    ['label' => Yii::t('app', 'Cursos'), 'url' => ['/producto/admin'], 'visible' => AccessHelpers::getAcceso('producto/index')],                
                    ['label' => Yii::t('app', 'Operaciones'), 'url' => ['/operacion'], 'visible' => AccessHelpers::getAcceso('operacion/index')],
                    ['label' => Yii::t('app', 'Pagos'), 'url' => ['/pagos'], 'visible' => AccessHelpers::getAcceso('pagos/index')],
                    ['label' => Yii::t('app', 'Países'), 'url' => ['/pais'], 'visible' => AccessHelpers::getAcceso('pais/index')],                
                    ['label' => Yii::t('app', 'Roles'), 'url' => ['/rol'], 'visible' => AccessHelpers::getAcceso('rol/index')],
                    ['label' => Yii::t('app', 'Usuarios'), 'url' => ['/user'], 'visible' => AccessHelpers::getAcceso('user/index')],
                    '<li class="divider"></li>',
                    ['label' => Yii::t('app', 'Configuración general'), 'url' => ['/app-config'], 'visible' => AccessHelpers::getAcceso('app-config/index')],
                ],
            ],
            [
                'label' => Yii::t('app', 'Mi cuenta'),
                'items' => [
                    '<li class="dropdown-header" style="color: #2ea2eb;"> ' . Yii::$app->user->identity->username . '</li>',
                    ['label' => Yii::t('app', 'Mi perfil'), 'url' => ['/site/my-profile']],
                    ['label' => Yii::t('app', 'Cambiar contraseña'), 'url' => ['/user/change-password']],
                    '<li class="divider"></li>',
                    ['label' => Yii::t('app', 'Cerrar sesión'), 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                ],
            ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; PonderNET <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>

<script>
    function enviarFormNuevaCarpeta()
    {
        document.getElementById("formNuevaCarpeta").submit();
    }
</script>

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

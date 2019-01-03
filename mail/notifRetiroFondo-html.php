<?php
use yii\helpers\Html;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$officeLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/oficina']);
$verSitio = \Yii::$app->urlManager->createAbsoluteUrl(['site']);

?>
<div class="password-reset">
    <p>
        <?= SiteController::translate('Hello') ?>,  <?= $model['username'] ?>.<br/>
        <?= SiteController::translate('You have just gained access to retire your funds on ') ?>
        <a href="<?= $verSitio ?>"><?= Yii::$app->name ?></a>
    </p>
    
    <p><?= SiteController::translate('Please, follow the link below to visit your office:') ?></p>
    <?= Html::a(Html::encode($officeLink), $officeLink) ?>

</div>

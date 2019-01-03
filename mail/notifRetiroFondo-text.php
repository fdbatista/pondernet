<?php
use yii\helpers\Html;
use app\controllers\SiteController;

$officeLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/oficina']);
$verSitio = \Yii::$app->urlManager->createAbsoluteUrl(['site']);

?>

<?= SiteController::translate('Hello') ?>, <?= $model['username'] ?>.
<?= SiteController::translate('You have just gained access to retire your funds on ') ?>
<a href="<?= $verSitio ?>"><?= Yii::$app->name ?></a>

<?= SiteController::translate('Please, follow the link below to visit your office:') ?>
<?= Html::a(Html::encode($officeLink), $officeLink) ?>

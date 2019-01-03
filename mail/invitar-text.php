<?php
use yii\helpers\Html;
use app\controllers\SiteController;

if ($curso)
{
    $signupLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/signup', 'referente' => Yii::$app->user->identity->username, 'id_curso' => $curso->id]);
    $verCurso = \Yii::$app->urlManager->createAbsoluteUrl(['producto/view', 'id' => $curso->id]);
}
else
{
    $signupLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/signup', 'referente' => Yii::$app->user->identity->username]);
    $verCurso = null;
}

$verSitio = \Yii::$app->urlManager->createAbsoluteUrl(['site']);

?>
<?= SiteController::translate('Dear user:') ?>
<?= Yii::$app->user->identity->nombre . ' ' . Yii::$app->user->identity->apellidos . ' (' . Yii::$app->user->identity->email . ') ' ?>
<?= SiteController::translate('has sent you an invitation to ') ?>
    <?php
        if (isset($curso))
            echo SiteController::translate('buy the course ') . "<a href=\"$verCurso\">" . $curso->nombre . '</a>';
        else
            echo SiteController::translate('join him');
        echo SiteController::translate(' on ') . "<a href=\"$verSitio\">" . Yii::$app->name . '</a>';
    ?>
<?= SiteController::translate('Please, follow the link below to accept it:') ?>
<?= Html::a(Html::encode($signupLink), $signupLink) ?>

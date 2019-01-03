<?php
use yii\helpers\Html;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $user app\models\User */

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
<div class="password-reset">
    <p>
        <?= SiteController::translate('Dear user:') ?><br/>
        <?= Yii::$app->user->identity->nombre . ' ' . Yii::$app->user->identity->apellidos . ' (' . Yii::$app->user->identity->email . ') ' ?>
        <?= SiteController::translate('has sent you an invitation to ') ?>
        <?php
            if (isset($curso))
                echo SiteController::translate('buy the course ') . "<a href=\"$verCurso\">" . $curso->nombre . '</a>';
            else
                echo SiteController::translate('join him');
            echo SiteController::translate(' on ') . "<a href=\"$verSitio\">" . Yii::$app->name . '</a>';
        ?>
    </p>
    
    <p><?= SiteController::translate('Please, follow the link below to accept it:') ?></p>

    <p><?= Html::a(Html::encode($signupLink), $signupLink) ?></p>
</div>

<?php

use app\controllers\SiteController;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/activate-user', 'token' => $user->auth_key]);
?>
<?= SiteController::translate('Hello') ?>, <?= $user->username ?>.
<?php
    if ($id_curso)
    {
        echo SiteController::translate('Since you have bought your first course, your account is already active.');
        echo SiteController::translate('Thanks for joining us!');
    }
    else
    {
        echo SiteController::translate('Follow the link below to activate your user account:');
        echo Html::a(Html::encode($resetLink), $resetLink);
    }
?>

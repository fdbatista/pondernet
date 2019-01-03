<?php
use yii\helpers\Html;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p><?= SiteController::translate('Hello') ?>, <?= Html::encode($user->username) ?>.</p>

    <p><?= SiteController::translate('Follow the link below to reset your password:') ?></p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>

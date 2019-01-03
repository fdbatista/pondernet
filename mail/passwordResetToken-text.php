<?php
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<?= SiteController::translate('Hello') ?>, <?= $user->username ?>.

<?= SiteController::translate('Follow the link below to reset your password:') ?>

<?= $resetLink ?>

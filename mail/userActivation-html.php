<?php
use yii\helpers\Html;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/activate-user', 'token' => $user->auth_key]);
?>
<div class="password-reset">
    <p><?= SiteController::translate('Hello') ?>, <?= Html::encode($user->username) ?>.</p>
    <p><?= SiteController::translate('You have succesfully created an user account on') ?> <?= Yii::$app->name . ' ' . SiteController::translate('with the following information: ') ?> </p>
    <p>
        <?= SiteController::translate('Username') . ': ' . $user->username?><br/>
        <?= SiteController::translate('Password') . ': ' . $password ?>
    </p>
    <?php
        if ($id_curso)
        {
            echo '<p>' . SiteController::translate('Since you have bought your first course, your account is already active.') . '</p>';
            echo '<p>' . SiteController::translate('Thanks for joining us!') . '</p>';
        }
        else
        {
            echo '<p>' . SiteController::translate('Follow the link below to activate your user account:') . '</p>';
            echo '<p>' . Html::a(Html::encode($resetLink), $resetLink) . '</p>';
        }
    ?>
    
    
</div>

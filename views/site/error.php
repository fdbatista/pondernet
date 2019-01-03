<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use app\controllers\SiteController;

$this->title = $name;
?>
<div class="site-error">
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= SiteController::translate($message) ?>
    </div>

    <p>
        <?= SiteController::translate('The above error occurred while the Web server was processing your request.') ?>
    </p>
    <p>
        <?= SiteController::translate('Please contact us if you think this is a server error. Thank you.') ?>
    </p>

</div>

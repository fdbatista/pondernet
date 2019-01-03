<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\controllers\SiteController;

$this->title = SiteController::translate('About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) . ' ' . Yii::$app->name ?></h1>
    <div class="container">
        <p class="text-justify">
            <?= SiteController::translate('PonderNET is an online community focused on education. It\'s a buy & sell platform with different educative resources: a complete set of digital tools and products to get people closer to success.') ?><br/><br/>
            <?= SiteController::translate('While the user gets educated, he has the opportunity of joining our system and becoming a part of an online business full of opportunities, that allows him to increase his income and personal life. And everything comes through knowledge!') ?><br/><br/>
            <?= SiteController::translate('PonderNET looks for a balance in people\'s lives through an updated educational offer, making a good use of the latest technological tools. PonderNET is the seed of a worldwide family which most valuable asset is learning, which makes it possible to obtain economical prosperity.') ?><br/><br/>
            <?= SiteController::translate('Join us!') ?>
        </p>
        <code>Copyright &copy; <?= date('Y') . SiteController::translate(' by ') . Yii::$app->name ?></code>
    </div>
    
</div>

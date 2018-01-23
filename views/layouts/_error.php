<?php

use yii\helpers\Html;

/* @var $message string */
/* @var $this yii\web\View */

$this->title = "Errors is everywhere...";

?>

<div class="site-error">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-info">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <p>The above error occurred while the Web server was processing your request.</p>
    <p>
        Please <?= Html::mailto('contact us', Yii::$app->params['adminEmail']) ?> if you think this is a server error. Thank you.
    </p>

</div>

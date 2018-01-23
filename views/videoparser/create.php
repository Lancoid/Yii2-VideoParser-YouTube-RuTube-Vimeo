<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\record\VideoParserRecord */

$this->title = 'New record?';
$this->params['breadcrumbs'][] = ['label' => 'VideosPaser', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="video-create">
    <h2 class="page-header"><?= Html::encode($this->title) ?></h2>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>

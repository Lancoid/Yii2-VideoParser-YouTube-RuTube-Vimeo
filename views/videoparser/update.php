<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\record\VideoParserRecord */

$this->title = 'Edit video';
$this->params['breadcrumbs'][] = ['label' => 'VideosPaser', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';

?>

<div class="service-record-update">
    <h2 class="page-header"><?= Html::encode($this->title) . ' - ' . $model->title ?></h2>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>

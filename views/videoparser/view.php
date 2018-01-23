<?php

use app\models\VideoParser;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\record\VideoParserRecord */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'VideosPaser', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    $var = $model->video_id;

    if ($model->service == VideoParser::YOUTUBE_SERVICE) { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="div-iframe">
                    <iframe src="http://www.youtube.com/embed/<?= $var ?>" class="iframe"
                            webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:20px">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Description</div>
                    <div class="panel-body"><?= Yii::$app->formatter->asNtext($model->description); ?></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">HTML-code</div>
                    <div class="panel-body">
                        &lt;iframe src="http://www.youtube.com/embed/<?= $var ?>"
                        style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;"
                        webkitallowfullscreen mozallowfullscreen allowfullscreen>&lt;/iframe>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Prereview's link</div>
                    <div class="panel-body"><?= $model->thumbnail ?></div>
                </div>
            </div>
        </div>

        <?php
    } elseif ($model->service == VideoParser::RUTUBE_SERVICE) { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="div-iframe">
                    <iframe src="https://rutube.ru/play/embed/<?= $var ?>?" class="iframe"
                            webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:20px">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Description</div>
                    <div class="panel-body"><?= Yii::$app->formatter->asNtext($model->description); ?></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">HTML-code</div>
                    <div class="panel-body">
                        &lt;iframe src="https://rutube.ru/play/embed/<?= $var ?>?"
                        style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;"
                        webkitallowfullscreen mozallowfullscreen allowfullscreen>&lt;/iframe>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Prereview's link</div>
                    <div class="panel-body"><?= $model->thumbnail ?></div>
                </div>
            </div>
        </div>
        <?php
    } elseif ($model->service == VideoParser::VIMEO_SERVICE) { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="div-iframe">
                    <iframe src="https://player.vimeo.com/video/<?= $var ?>" class="iframe"
                            webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:20px">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Description</div>
                    <div class="panel-body"><?= Yii::$app->formatter->asRaw($model->description); ?></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">HTML-code</div>
                    <div class="panel-body">
                        &lt;iframe src="https://player.vimeo.com/video/<?= $var ?>"
                        style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;"
                        webkitallowfullscreen mozallowfullscreen allowfullscreen>&lt;/iframe>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Prereview's link</div>
                    <div class="panel-body"><?= $model->thumbnail ?></div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<?php

use app\models\VideoParser;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model \app\models\record\VideoParserRecord */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'VideosParser';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="video-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <p><?= Html::a('New record?', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-hover'
        ],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['class' => 'text-center padding-top-bottom-10',],
            ],
            [
                'attribute' => 'title',
                'contentOptions' => ['class' => 'text-left padding-top-bottom-10',],
            ],
            [
                'attribute' => 'description',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-justify padding-top-bottom-10',],
                'value' => function ($data) {
                    $text = StringHelper::truncate($data->description, 400);

                    if ($data->service == VideoParser::YOUTUBE_SERVICE) {
                        return Yii::$app->formatter->asNtext($text);
                    } elseif ($data->service == VideoParser::RUTUBE_SERVICE) {
                        return Yii::$app->formatter->asRaw($text);
                    } elseif ($data->service == VideoParser::VIMEO_SERVICE) {
                        return Yii::$app->formatter->asRaw($text);
                    }
                }
            ],
            [
                'attribute' => 'thumbnail',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img($data->thumbnail, ['alt' => 'thumbnail', 'width' => '250', 'height' => 'auto']);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

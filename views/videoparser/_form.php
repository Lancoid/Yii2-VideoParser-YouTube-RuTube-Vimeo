<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $form ActiveForm */
/* @var $this yii\web\View */
/* @var $model \app\models\record\VideoParserRecord */

?>

<div class="video-update">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <dl class="dl-horizontal">
        <dt></dt>
        <dd>
            <h3>supported links types</h3>
        </dd>
        <dt>YOUTUBE</dt>
        <dd>
            youtube.com/v/video_ID<br>
            www.youtube.com/embed/video_ID<br>
            http://www.youtube.com/watch?v=video_ID<br>
            https://m.youtube.com/watch?v=video_ID<br>
            https://youtu.be/video_ID<br><br>
        </dd>
        <dt>RUTUBE</dt>
        <dd>
            rutube.ru/tracks/video_ID.html<br>
            http://rutube.ru/video/video_ID<br>
            https://rutube.ru/video/video_ID<br>
            https://www.rutube.ru/video/embed/video_ID<br><br>
        </dd>
        <dt>VIMEO</dt>
        <dd>
            vimeo.com/video_ID<br>
            www.vimeo.com/video_ID<br>
            http://vimeo.com/album/album_name/video/video_ID<br>
            https://vimeo.com/channels/channels_name/video_ID<br>
            https://vimeo.com/groups/groups_name/videos/video_ID
        </dd>
    </dl>

</div>

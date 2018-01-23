<?php

namespace app\models\record;

use app\models\VideoParser;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "video_parser".
 *
 * @property int     $id
 * @property string  $video_id
 * @property integer $service
 * @property string  $title
 * @property string  $description
 * @property string  $thumbnail
 * @property string  $url
 */
class VideoParserRecord extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video_parser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service'], 'integer'],
            [['description'], 'string'],
            [['video_id', 'title', 'thumbnail'], 'string', 'max' => 255],
            [
                ['url'],
                'unique',
                'message' => 'Record (with this URL) already exists!'
            ],
            [['url'], 'string'],
            [
                'url',
                'match',
                'pattern' => '%(?:youtube\.com/|youtu\.be/|rutube\.ru|vimeo\.com/)%i',
                'message' => 'Wrong URL! Only: youtube.com, rutube.ru & vimeo.com'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service' => 'Video service',
            'video_id' => 'Video ID',
            'title' => 'Title',
            'description' => 'Description',
            'thumbnail' => 'Thumbnail',
            'url' => 'URL',
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $return = parent::beforeSave($insert);

        $parser = new VideoParser;
        $data = $parser->identifyServiceAndGetInfo($this->url);

        $this->service = $data['service'];
        $this->video_id = $data['video_id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->thumbnail = $data['thumbnail'];
        $this->url = $data['url'];

        return $return;
    }
}

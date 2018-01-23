<?php

use yii\db\Migration;

/**
 * Handles the creation of table `video_parser`.
 */
class m180121_182316_create_video_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('video_parser', [
            'id' => $this->primaryKey(),
            'service' => $this->integer(),
            'video_id' => $this->string(),
            'title' => $this->string(),
            'description' => $this->text(),
            'thumbnail' => $this->string(),
            'url' => $this->string()->unique(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('video_parser');
    }
}

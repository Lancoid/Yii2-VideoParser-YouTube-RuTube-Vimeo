<?php

namespace app\models\search;

use app\models\record\VideoParserRecord;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * VideoParserSearch represents the model behind the search form of `app\models\record\VideoParserRecord`.
 */
class VideoParserSearch extends VideoParserRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service', 'title', 'description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = VideoParserRecord::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['like', 'service', $this->service])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}

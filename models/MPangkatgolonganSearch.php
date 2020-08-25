<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MPangkatgolongan;

/**
 * MPangkatgolonganSearch represents the model behind the search form about `app\models\MPangkatgolongan`.
 */
class MPangkatgolonganSearch extends MPangkatgolongan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['jenis', 'golongan', 'ruang'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MPangkatgolongan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'jenis', $this->jenis])
            ->andFilterWhere(['like', 'golongan', $this->golongan])
            ->andFilterWhere(['like', 'ruang', $this->ruang]);

        return $dataProvider;
    }
}

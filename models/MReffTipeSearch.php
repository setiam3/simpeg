<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MReffTipe;

/**
 * MReffTipeSearch represents the model behind the search form about `app\models\MReffTipe`.
 */
class MReffTipeSearch extends MReffTipe
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipereff_id'], 'integer'],
            [['nama_reff_tipe', 'status'], 'safe'],
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
        $query = MReffTipe::find();

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
            'tipereff_id' => $this->tipereff_id,
        ]);

        $query->andFilterWhere(['like', 'nama_reff_tipe', $this->nama_reff_tipe])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MTunjangan;

/**
 * MTunjanganSearch represents the model behind the search form of `app\models\MTunjangan`.
 */
class MTunjanganSearch extends MTunjangan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tunjangan_id', 'id_data'], 'integer'],
            [['nominal'], 'number'],
            [['status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = MTunjangan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tunjangan_id' => $this->tunjangan_id,
            'nominal' => $this->nominal,
            'id_data' => $this->id_data,
        ]);

        $query->andFilterWhere(['ilike', 'status', $this->status]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MRekening;

/**
 * MRekeningSearch represents the model behind the search form of `app\models\MRekening`.
 */
class MRekeningSearch extends MRekening
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_data', 'bank_id'], 'integer'],
            [['nomor_rekening', 'npwp', 'fotoNpwp', 'fotoRekening'], 'safe'],
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
        $query = MRekening::find();

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
            'id_data' => $this->id_data,
            'bank_id' => $this->bank_id,
        ]);

        $query->andFilterWhere(['ilike', 'nomor_rekening', $this->nomor_rekening])
            ->andFilterWhere(['ilike', 'npwp', $this->npwp])
            ->andFilterWhere(['ilike', 'fotoNpwp', $this->fotoNpwp])
            ->andFilterWhere(['ilike', 'fotoRekening', $this->fotoRekening]);

        return $dataProvider;
    }
}

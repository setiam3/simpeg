<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Paktaintegritas;

/**
 * PaktaintegritasSearch represents the model behind the search form of `app\models\Paktaintegritas`.
 */
class PaktaintegritasSearch extends Paktaintegritas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nomer', 'jabatan', 'tanggal', 'ttd', 'nama','id_data'], 'safe'],
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
        $query = Paktaintegritas::find();
        $query->join('join','m_biodata','pakta_integritas.id_data = m_biodata.id_data');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ]
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
//            'id_data' => $this->id_data,
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['ilike', 'nomer', $this->nomer])
            ->andFilterWhere(['ilike', 'jabatan', $this->jabatan])
            ->andFilterWhere(['like', 'nama', $this->id_data])
            ->andFilterWhere(['ilike', 'ttd', $this->ttd]);

        return $dataProvider;
    }
}

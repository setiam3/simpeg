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
            [['id', 'id_data'], 'integer'],
            [['nomer', 'jabatan', 'tanggal', 'ttd'], 'safe'],
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
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['ilike', 'nomer', $this->nomer])
            ->andFilterWhere(['ilike', 'jabatan', $this->jabatan])
            ->andFilterWhere(['ilike', 'ttd', $this->ttd]);

        return $dataProvider;
    }
}

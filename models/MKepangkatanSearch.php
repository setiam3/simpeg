<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MKepangkatan;

/**
 * MKepangkatanSearch represents the model behind the search form of `app\models\MKepangkatan`.
 */
class MKepangkatanSearch extends MKepangkatan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_data', 'penggolongangaji_id', 'fk_golongan'], 'integer'],
            [['ditetapkanOleh', 'noSk', 'tglSk', 'tmtPangkat', 'ruang', 'tmt', 'dokumen'], 'safe'],
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
        $query = MKepangkatan::find();

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
            'tglSk' => $this->tglSk,
            'penggolongangaji_id' => $this->penggolongangaji_id,
            'tmtPangkat' => $this->tmtPangkat,
            'fk_golongan' => $this->fk_golongan,
        ]);

        $query->andFilterWhere(['ilike', 'ditetapkanOleh', $this->ditetapkanOleh])
            ->andFilterWhere(['ilike', 'noSk', $this->noSk])
            ->andFilterWhere(['ilike', 'ruang', $this->ruang])
            ->andFilterWhere(['ilike', 'tmt', $this->tmt])
            ->andFilterWhere(['ilike', 'dokumen', $this->dokumen]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MRiwayatjabatan;

/**
 * MRiwayarjabatanSearch represents the model behind the search form of `app\models\MRiwayatjabatan`.
 */
class MRiwayarjabatanSearch extends MRiwayatjabatan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nip', 'namaJabatan', 'eselon', 'noSk', 'tglSk', 'tmtJabatan'], 'safe'],
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
        $query = MRiwayatjabatan::find();

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
            'tglSk' => $this->tglSk,
            'tmtJabatan' => $this->tmtJabatan,
        ]);

        $query->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'namaJabatan', $this->namaJabatan])
            ->andFilterWhere(['like', 'eselon', $this->eselon])
            ->andFilterWhere(['like', 'noSk', $this->noSk]);

        return $dataProvider;
    }
}

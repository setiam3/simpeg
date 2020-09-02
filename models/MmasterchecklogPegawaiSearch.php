<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MmasterchecklogPegawai;

/**
 * MmasterchecklogPegawaiSearch represents the model behind the search form of `app\models\MmasterchecklogPegawai`.
 */
class MmasterchecklogPegawaiSearch extends MmasterchecklogPegawai
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['checklogpegawai_id', 'nama_checklogpegawai', 'status_checklogpegawai', 'nip'], 'safe'],
            [['id_data'], 'integer'],
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
        $query = MmasterchecklogPegawai::find();

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
            'id_data' => $this->id_data,
        ]);

        $query->andFilterWhere(['ilike', 'checklogpegawai_id', $this->checklogpegawai_id])
            ->andFilterWhere(['ilike', 'nama_checklogpegawai', $this->nama_checklogpegawai])
            ->andFilterWhere(['ilike', 'status_checklogpegawai', $this->status_checklogpegawai])
            ->andFilterWhere(['ilike', 'nip', $this->nip]);

        return $dataProvider;
    }
}

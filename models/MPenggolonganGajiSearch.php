<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MPenggolonganGaji;

/**
 * MPenggolonganGajiSearch represents the model behind the search form of `app\models\MPenggolonganGaji`.
 */
class MPenggolonganGajiSearch extends MPenggolonganGaji
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pangkat_id', 'masa_kerja', 'jenis_pegawai'], 'integer'],
            [['gaji', 'status_penggolongan', 'ruang'], 'safe'],
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
        $query = MPenggolonganGaji::find();

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
            'pangkat_id' => $this->pangkat_id,
            'masa_kerja' => $this->masa_kerja,
            'jenis_pegawai' => $this->jenis_pegawai,
        ]);

        $query->andFilterWhere(['ilike', 'gaji', $this->gaji])
            ->andFilterWhere(['ilike', 'status_penggolongan', $this->status_penggolongan])
            ->andFilterWhere(['ilike', 'ruang', $this->ruang]);

        return $dataProvider;
    }
}

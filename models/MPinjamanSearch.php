<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MPinjaman;

/**
 * MPinjamanSearch represents the model behind the search form about `app\models\MPinjaman`.
 */
class MPinjamanSearch extends MPinjaman
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tanggal', 'jenis', 'namaBarang', 'id_data'], 'safe'],
            [['jumlah'], 'number'],
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
        $query = MPinjaman::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('data');
        //$query->joinWith('jens');

        $query->andFilterWhere([
            'id' => $this->id,
            //'id_data' => $this->id_data,
            'tanggal' => $this->tanggal,
            'jumlah' => $this->jumlah,
        ]);

        $query->andFilterWhere(['like', 'm_referensi.nama_referensi', $this->jenis])
            ->andFilterWhere(['like', 'namaBarang', $this->namaBarang])
            ->andFilterWhere(['like', 'm_biodata.nama', $this->id_data]);

        return $dataProvider;
    }
}

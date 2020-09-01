<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Riwayatpendidikan;

/**
 * RiwayatpendidikanSearch represents the model behind the search form of `app\models\Riwayatpendidikan`.
 */
class RiwayatpendidikanSearch extends Riwayatpendidikan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_data'], 'integer'],
            [['tingkatPendidikan', 'jurusan', 'namaSekolah', 'thLulus', 'dokumen'], 'safe'],
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
        $query = Riwayatpendidikan::find();

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
        ]);

        $query->andFilterWhere(['ilike', 'tingkatPendidikan', $this->tingkatPendidikan])
            ->andFilterWhere(['ilike', 'jurusan', $this->jurusan])
            ->andFilterWhere(['ilike', 'namaSekolah', $this->namaSekolah])
            ->andFilterWhere(['ilike', 'thLulus', $this->thLulus])
            ->andFilterWhere(['ilike', 'dokumen', $this->dokumen]);

        return $dataProvider;
    }
}

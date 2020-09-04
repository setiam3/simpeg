<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MRiwayatdiklat;

/**
 * MRiwayatdiklatSearch represents the model behind the search form about `app\models\MRiwayatdiklat`.
 */
class MRiwayatdiklatSearch extends MRiwayatdiklat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['namaDiklat', 'id_data', 'tempat', 'penyelenggara', 'mulai', 'selesai', 'dokumen'], 'safe'],
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
    public function search($params,$where=null)
    {
        $query = MRiwayatdiklat::find()->where($where);

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

        $query->andFilterWhere([
            'id' => $this->id,
            //'id_data' => $this->id_data,
            'mulai' => $this->mulai,
            'selesai' => $this->selesai,
        ]);

        $query->andFilterWhere(['like', 'namaDiklat', $this->namaDiklat])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'penyelenggara', $this->penyelenggara])
            ->andFilterWhere(['like', 'dokumen', $this->dokumen])
            ->andFilterWhere(['like', 'm_biodata.nama', $this->id_data]);

        return $dataProvider;
    }
}

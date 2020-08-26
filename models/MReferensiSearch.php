<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MReferensi;

/**
 * MReferensiSearch represents the model behind the search form about `app\models\MReferensi`.
 */
class MReferensiSearch extends MReferensi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reff_id', 'tipe_referensi'], 'integer'],
            [['nama_referensi', 'status'], 'safe'],
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
        $query = MReferensi::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'reff_id' => $this->reff_id,
            'tipe_referensi' => $this->tipe_referensi,
        ]);

        $query->andFilterWhere(['like', 'nama_referensi', $this->nama_referensi])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}

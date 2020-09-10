<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MTunjangan;

/**
 * MTunjanganSearch represents the model behind the search form about `app\models\MTunjangan`.
 */
class MTunjanganSearch extends MTunjangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',], 'integer'],
            [['nominal'], 'number'],
            [['status','tunjangan_id','id_data'], 'safe'],
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
        $query = MTunjangan::find();
        $query->joinWith('tunjangan');
        $query->joinWith('data');

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
            'id' => $this->id,
//            'tunjangan_id' => $this->tunjangan_id,
            'nominal' => $this->nominal,
//            'id_data' => $this->id_data,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'm_referensi.nama_referensi', $this->tunjangan_id])
            ->andFilterWhere(['like', 'm_biodata.nama', $this->id_data]);

        return $dataProvider;
    }
}

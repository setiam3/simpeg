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
        $query->alias('t');
        $query->joinWith('tunjangan as r');
        $query->joinWith('data as b');

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
            'nominal' => $this->nominal,
            't.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'r.nama_referensi', $this->tunjangan_id])
            ->andFilterWhere(['like', 'b.nama', $this->id_data]);

        return $dataProvider;
    }
}

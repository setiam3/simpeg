<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MTunjangan;
class MTunjanganSearch extends MTunjangan
{
    public function rules()
    {
        return [
            [['id',], 'integer'],
            [['nominal'], 'number'],
            [['status','tunjangan_id','id_data'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
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

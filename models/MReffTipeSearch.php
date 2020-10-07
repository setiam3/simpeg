<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MReffTipe;
class MReffTipeSearch extends MReffTipe
{
    public function rules()
    {
        return [
            [['tipereff_id'], 'integer'],
            [['nama_reff_tipe', 'status'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = MReffTipe::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'tipereff_id' => $this->tipereff_id,
        ]);
        $query->andFilterWhere(['like', 'nama_reff_tipe', $this->nama_reff_tipe])
            ->andFilterWhere(['like', 'status', $this->status]);
        return $dataProvider;
    }
}

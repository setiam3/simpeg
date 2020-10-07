<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MReferensi;
class MReferensiSearch extends MReferensi
{
    public function rules()
    {
        return [
            [['reff_id', 'tipe_referensi'], 'integer'],
            [['nama_referensi', 'status'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = MReferensi::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
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

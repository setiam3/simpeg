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
            [['reff_id'], 'integer'],
            [['nama_referensi','tipe_referensi', 'status'], 'safe'],
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
        $query->joinWith('tipeReferensi as t');
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'reff_id' => $this->reff_id,
        ]);
        $query->andFilterWhere(['like', 'nama_referensi', $this->nama_referensi])
            ->andFilterWhere(['like', 't.nama_reff_tipe', $this->tipe_referensi])
            ->andFilterWhere(['like', 'status', $this->status]);
        return $dataProvider;
    }
}

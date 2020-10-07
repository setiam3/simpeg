<?php
namespace app\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MchecklogPegawai;
class MchecklogPegawaiSearch extends MchecklogPegawai
{
    public function rules()
    {
        return [
            [['cheklog_id'], 'integer'],
            [['checklogpegawai_id', 'kedatangan', 'pulang'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = MchecklogPegawai::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'cheklog_id' => $this->cheklog_id,
            'kedatangan' => $this->kedatangan,
            'pulang' => $this->pulang,
        ]);
        $query->andFilterWhere(['ilike', 'checklogpegawai_id', $this->checklogpegawai_id]);
        return $dataProvider;
    }
}

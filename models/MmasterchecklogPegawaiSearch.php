<?php
namespace app\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MmasterchecklogPegawai;
class MmasterchecklogPegawaiSearch extends MmasterchecklogPegawai
{
    public function rules()
    {
        return [
            [['checklogpegawai_id', 'nama_checklogpegawai', 'status_checklogpegawai', 'nip'], 'safe'],
            [['id_data'], 'integer'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = MmasterchecklogPegawai::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_data' => $this->id_data,
        ]);
        $query->andFilterWhere(['ilike', 'checklogpegawai_id', $this->checklogpegawai_id])
            ->andFilterWhere(['ilike', 'nama_checklogpegawai', $this->nama_checklogpegawai])
            ->andFilterWhere(['ilike', 'status_checklogpegawai', $this->status_checklogpegawai])
            ->andFilterWhere(['ilike', 'nip', $this->nip]);
        return $dataProvider;
    }
}

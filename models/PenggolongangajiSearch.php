<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Penggolongangaji;
class PenggolongangajiSearch extends Penggolongangaji
{
    public function rules()
    {
        return [
            [['id', 'masa_kerja',], 'integer'],
            [['gaji', 'status_penggolongan', 'ruang','pangkat_id','jenis_pegawai'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = Penggolongangaji::find();
        $query->joinWith('pangkat as r');
        $query->joinWith('jenisPegawai as r');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'masa_kerja' => $this->masa_kerja,
        ]);
        $query->andFilterWhere(['like', 'gaji', $this->gaji])
            ->andFilterWhere(['like', 'status_penggolongan', $this->status_penggolongan])
            ->andFilterWhere(['like', 'r.nama_referensi', $this->pangkat_id])
            ->andFilterWhere(['like', 'r.nama_referensi', $this->jenis_pegawai])
            ->andFilterWhere(['like', 'ruang', $this->ruang]);
        return $dataProvider;
    }
}

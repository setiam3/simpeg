<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MBiodata;
class MKeluargaSearch extends MBiodata
{
    public function rules()
    {
        return [
            [['id_data', 'parent_id', 'status_hubungan_keluarga', 'checklog_id'], 'integer'],
            [['nip', 'nama', 'tempatLahir', 'tanggalLahir', 'alamat', 'kabupatenKota', 'kecamatan', 'kelurahan', 'jenisKelamin', 'agama', 'telp', 'email', 'statusPerkawinan', 'gelarDepan', 'gelarBelakang', 'nik', 'foto', 'fotoNik', 'golonganDarah', 'is_pegawai'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params,$where=NULL)
    {
        $query = MBiodata::find()->where($where)->andWhere(['not',['status_hubungan_keluarga'=>NULL]])->andWhere(['is_pegawai'=>'0']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_data' => $this->id_data,
            'parent_id' => $this->parent_id,
            'tanggalLahir' => $this->tanggalLahir,
            'status_hubungan_keluarga' => $this->status_hubungan_keluarga,
        ]);
        $query->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tempatLahir', $this->tempatLahir])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'kabupatenKota', $this->kabupatenKota])
            ->andFilterWhere(['like', 'kecamatan', $this->kecamatan])
            ->andFilterWhere(['like', 'kelurahan', $this->kelurahan])
            ->andFilterWhere(['like', 'jenisKelamin', $this->jenisKelamin])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'telp', $this->telp])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'statusPerkawinan', $this->statusPerkawinan])
            ->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'fotoNik', $this->fotoNik])
            ->andFilterWhere(['like', 'golonganDarah', $this->golonganDarah]);
        return $dataProvider;
    }
}

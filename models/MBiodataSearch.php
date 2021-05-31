<?php
namespace app\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MBiodata;
class MBiodataSearch extends MBiodata
{
    public function rules()
    {
        return [
            [['id_data', 'parent_id', 'status_hubungan_keluarga', 'checklog_id'], 'integer'],
            [['nip','nama', 'tempatLahir', 'tanggalLahir', 'alamat', 'kabupatenKota', 'kecamatan', 'kelurahan', 'jenisKelamin', 'agama', 'telp', 'email', 'statusPerkawinan', 'gelarDepan', 'gelarBelakang', 'nik', 'foto', 'fotoNik', 'golonganDarah','jenis_pegawai', 'is_pegawai'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = MBiodata::find()->where(['is_pegawai'=>'1']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->joinWith('jenispegawai as j');
        $query->andFilterWhere([
            'id_data' => $this->id_data,
            'parent_id' => $this->parent_id,
            'tanggalLahir' => $this->tanggalLahir,
            'status_hubungan_keluarga' => $this->status_hubungan_keluarga,
            'checklog_id' => $this->checklog_id,
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
            ->andFilterWhere(['like', 'gelarDepan', $this->gelarDepan])
            ->andFilterWhere(['like', 'gelarBelakang', $this->gelarBelakang])
            ->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'fotoNik', $this->fotoNik])
            ->andFilterWhere(['like', 'golonganDarah', $this->golonganDarah])
            ->andFilterWhere(['like', 'j.nama_referensi', $this->jenis_pegawai])
            ->andFilterWhere(['like', 'is_pegawai', $this->is_pegawai]);
        return $dataProvider;
    }
}

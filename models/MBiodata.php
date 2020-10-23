<?php
namespace app\models;
use Yii;
class MBiodata extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'm_biodata';
    }
    public function rules()
    {
        return [
            [['parent_id', 'status_hubungan_keluarga', 'checklog_id'], 'default', 'value' => null],
            [['parent_id', 'status_hubungan_keluarga', 'checklog_id','jenis_pegawai'], 'integer'],
            [['nama', 'tempatLahir', 'tanggalLahir', 'alamat', 'jenisKelamin', 'agama', 'nik'], 'required'],
            [['tanggalLahir'], 'safe'],
            [['nip', 'nama', 'alamat', 'kabupatenKota', 'kecamatan', 'kelurahan', 'jenisKelamin', 'email', 'foto', 'fotoNik', 'is_pegawai'], 'string', 'max' => 255],
            [['tempatLahir', 'agama'], 'string', 'max' => 200],
            [['telp', 'nik'], 'string', 'max' => 20],
            [['statusPerkawinan', 'gelarDepan', 'gelarBelakang'], 'string', 'max' => 100],
            [['golonganDarah'], 'string', 'max' => 2],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['parent_id' => 'id_data']],
            [['status_hubungan_keluarga'], 'exist', 'skipOnError' => true, 'targetClass' => MReferensi::className(), 'targetAttribute' => ['status_hubungan_keluarga' => 'reff_id']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id_data' => 'Id Data',
            'parent_id' => 'Parent ID',
            'nip' => 'Nip',
            'nama' => 'Nama',
            'tempatLahir' => 'Tempat Lahir',
            'tanggalLahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'kabupatenKota' => 'Kabupaten Kota',
            'kecamatan' => 'Kecamatan',
            'kelurahan' => 'Kelurahan',
            'jenisKelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'telp' => 'Telp',
            'email' => 'Email',
            'statusPerkawinan' => 'Status Perkawinan',
            'gelarDepan' => 'Gelar Depan',
            'gelarBelakang' => 'Gelar Belakang',
            'nik' => 'Nik',
            'foto' => 'Foto',
            'fotoNik' => 'Foto Nik',
            'golonganDarah' => 'Golongan Darah',
            'status_hubungan_keluarga' => 'Status Hubungan Keluarga',
            'is_pegawai' => 'Is Pegawai',
            'checklog_id' => 'Checklog ID',
            'jenis_pegawai'=>'Jenis Pegawai'
        ];
    }
    public function getNamalengkap(){
        return $this->gelarDepan.' '.$this->nama.' '.$this->gelarBelakang;
    }
    public function getKepangkatans()
    {
        return $this->hasMany(MKepangkatan::className(), ['id_data' => 'id_data']);
    }
    public function getParent()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'parent_id']);
    }
    public function getMBiodatas()
    {
        return $this->hasMany(MBiodata::className(), ['parent_id' => 'id_data']);
    }
    public function getStatusHubunganKeluarga()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'status_hubungan_keluarga']);
    }
    public function getMChecklogPegawais()
    {
        return $this->hasMany(MChecklogPegawai::className(), ['id_data' => 'id_data']);
    }
    public function getMRekenings()
    {
        return $this->hasMany(MRekening::className(), ['id_data' => 'id_data']);
    }
    public function getMTunjangans()
    {
        return $this->hasMany(MTunjangan::className(), ['id_data' => 'id_data']);
    }
    public function getPinjamen()
    {
        return $this->hasMany(Pinjaman::className(), ['id_data' => 'id_data']);
    }
    public function getRiwayatdiklats()
    {
        return $this->hasMany(Riwayatdiklat::className(), ['id_data' => 'id_data']);
    }
    public function getRiwayatjabatans()
    {
        return $this->hasMany(Riwayatjabatan::className(), ['id_data' => 'id_data']);
    }
    public function getRiwayatjabatan()
    {
        return $this->hasOne(Riwayatjabatan::className(), ['id_data' => 'id_data']);
    }
    public function getRiwayatpendidikans()
    {
        return $this->hasMany(Riwayatpendidikan::className(), ['id_data' => 'id_data']);
    }
    public function getDesanya(){
        return $this->hasOne(Kelurahan::className(),['id'=>'kelurahan']);
    }
    public function getStatuskawin(){
        return $this->hasOne(MReferensi::className(),['reff_id'=>'statusPerkawinan']);
    }
    public function getAgamanya(){
        return $this->hasOne(MReferensi::className(),['reff_id'=>'agama']);
    }
    public function getSex(){
        return $this->hasOne(MReferensi::className(),['reff_id'=>'jenisKelamin']);
    }
    public function getJenispegawai(){
        return $this->hasOne(MReferensi::className(),['reff_id'=>'jenis_pegawai']);
    }
    public function getUserid(){
        return $this->hasOne(\mdm\admin\models\User::className(),['id_data'=>'id_data']);
    }
    public function getSisacuti(){
        return $this->hasOne(Jatahcuti::className(),['id_data'=>'id_data']);
    }
}

<?php
namespace app\models;
use Yii;
class Riwayatpendidikan extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'riwayatpendidikan';
    }
    public function rules()
    {
        return [
            [['id_data', 'tingkatPendidikan'], 'required'],
            [['id_data', 'tingkatPendidikan', 'medis'], 'default', 'value' => null],
            [['id_data', 'tingkatPendidikan', 'medis'], 'integer'],
            [['tgl_ijazah', 'tgl_berlaku_ijin'], 'safe'],
            [['suratijin'], 'string'],
            [['jurusan', 'namaSekolah', 'dokumen'], 'string', 'max' => 255],
            [['thLulus', 'thMasuk'], 'string', 'max' => 4],
            [['no_ijazah'], 'string', 'max' => 100],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
            [['tingkatPendidikan'], 'exist', 'skipOnError' => true, 'targetClass' => MReferensi::className(), 'targetAttribute' => ['tingkatPendidikan' => 'reff_id']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data' => 'Nama Pegawai',
            'tingkatPendidikan' => 'Tingkat Pendidikan',
            'jurusan' => 'Jurusan',
            'namaSekolah' => 'Nama Sekolah',
            'thLulus' => 'Th Lulus',
            'dokumen' => 'Dokumen',
            'no_ijazah' => 'No Ijazah',
            'tgl_ijazah' => 'Tgl Ijazah',
            'thMasuk' => 'Th Masuk',
            'medis' => 'Medis',
            'suratijin' => 'Surat Ijin',
            'tgl_berlaku_ijin' => 'Tgl Berlaku Ijin',
        ];
    }
    public function getData()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'id_data']);
    }
    public function getTingpen()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'tingkatPendidikan']);
    }
}

<?php
namespace app\models;
use Yii;
class Penggolongangaji extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'penggolongangaji';
    }
    public function rules()
    {
        return [
            [['pangkat_id', 'gaji'], 'required'],
            [['pangkat_id', 'masa_kerja', 'jenis_pegawai', 'status_penggolongan'], 'default', 'value' => null],
            [['pangkat_id', 'masa_kerja', 'jenis_pegawai', 'status_penggolongan'], 'integer'],
            [['gaji'], 'number'],
            [['ruang'], 'string'],
            [['pangkat_id'], 'exist', 'skipOnError' => true, 'targetClass' => MReferensi::className(), 'targetAttribute' => ['pangkat_id' => 'reff_id']],
            [['jenis_pegawai'], 'exist', 'skipOnError' => true, 'targetClass' => MReferensi::className(), 'targetAttribute' => ['jenis_pegawai' => 'reff_id']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pangkat_id' => 'Pangkat ID',
            'masa_kerja' => 'Masa Kerja',
            'gaji' => 'Gaji',
            'ruang' => 'Ruang',
            'jenis_pegawai' => 'Jenis Pegawai',
            'status_penggolongan' => 'Status Penggolongan',
        ];
    }
    public function getKepangkatans()
    {
        return $this->hasMany(MKepangkatan::className(), ['penggolongangaji_id' => 'id']);
    }
    public function getPangkat()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'pangkat_id']);
    }
    public function getJenisPegawai()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'jenis_pegawai']);
    }
    public function getTransaksipenggajianDetails()
    {
        return $this->hasMany(TransaksipenggajianDetail::className(), ['gol_gaji' => 'id']);
    }
}

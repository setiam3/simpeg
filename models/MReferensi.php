<?php
namespace app\models;
use Yii;
class MReferensi extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'm_referensi';
    }
    public function rules()
    {
        return [
            [['tipe_referensi'], 'default', 'value' => null],
            [['tipe_referensi'], 'integer'],
            [['nama_referensi', 'status'], 'string', 'max' => 255],
            [['tipe_referensi'], 'exist', 'skipOnError' => true, 'targetClass' => MReffTipe::className(), 'targetAttribute' => ['tipe_referensi' => 'tipereff_id']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'reff_id' => 'Reff ID',
            'nama_referensi' => 'Nama Referensi',
            'tipe_referensi' => 'Tipe Referensi',
            'status' => 'Status',
        ];
    }
    public function getMBiodatas()
    {
        return $this->hasMany(MBiodata::className(), ['status_hubungan_keluarga' => 'reff_id']);
    }
    public function getTipeReferensi()
    {
        return $this->hasOne(MReffTipe::className(), ['tipereff_id' => 'tipe_referensi']);
    }
    public function getPenggolongangajis()
    {
        return $this->hasMany(Penggolongangaji::className(), ['pangkat_id' => 'reff_id']);
    }
    public function getPenggolongangajis0()
    {
        return $this->hasMany(Penggolongangaji::className(), ['golongan_id' => 'reff_id']);
    }
    public function getRiwayatjabatans()
    {
        return $this->hasMany(Riwayatjabatan::className(), ['id_jabatan' => 'reff_id']);
    }
}

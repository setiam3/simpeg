<?php
namespace app\models;
use Yii;
class MmasterchecklogPegawai extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'm_checklog_pegawai';
    }
    public function rules()
    {
        return [
            [['checklogpegawai_id', 'id_data'], 'required'],
            [['id_data'], 'default', 'value' => null],
            [['id_data'], 'integer'],
            [['checklogpegawai_id'], 'string', 'max' => 50],
            [['nama_checklogpegawai'], 'string', 'max' => 200],
            [['status_checklogpegawai'], 'string', 'max' => 10],
            [['nip'], 'string', 'max' => 100],
            [['checklogpegawai_id'], 'unique'],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'checklogpegawai_id' => 'Checklogpegawai ID',
            'id_data' => 'Id Data',
            'nama_checklogpegawai' => 'Nama Checklogpegawai',
            'status_checklogpegawai' => 'Status Checklogpegawai',
            'nip' => 'Nip',
        ];
    }
    public function getChecklogPegawais()
    {
        return $this->hasMany(ChecklogPegawai::className(), ['checklogpegawai_id' => 'checklogpegawai_id']);
    }
    public function getMBiodatas()
    {
        return $this->hasMany(MBiodata::className(), ['checklog_id' => 'checklogpegawai_id']);
    }
    public function getData()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'id_data']);
    }
}

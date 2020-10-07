<?php
namespace app\models;
use Yii;
class Riwayatdiklat extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'riwayatdiklat';
    }
    public function rules()
    {
        return [
            [['id_data', 'namaDiklat', 'tempat', 'penyelenggara', 'mulai', 'selesai'], 'required'],
            [['id_data'], 'default', 'value' => null],
            [['id_data'], 'integer'],
            [['mulai', 'selesai'], 'safe'],
            [['namaDiklat', 'tempat', 'penyelenggara', 'dokumen'], 'string', 'max' => 255],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data' => 'Nama Pegawai',
            'namaDiklat' => 'Nama Diklat',
            'tempat' => 'Tempat',
            'penyelenggara' => 'Penyelenggara',
            'mulai' => 'Mulai',
            'selesai' => 'Selesai',
            'dokumen' => 'Dokumen',
        ];
    }
    public function getData()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'id_data']);
    }
}

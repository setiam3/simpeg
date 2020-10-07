<?php
namespace app\models;
use Yii;
class Pinjaman extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'pinjaman';
    }
    public function rules()
    {
        return [
            [['id_data', 'tanggal', 'jenis', 'namaBarang', 'jumlah'], 'required'],
            [['id_data'], 'default', 'value' => null],
            [['id_data', 'jenis'], 'integer'],
            [['tanggal'], 'safe'],
            [['jumlah'], 'number'],
            [['namaBarang'], 'string', 'max' => 255],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data' => 'Nama',
            'tanggal' => 'Tanggal',
            'jenis' => 'Jenis',
            'namaBarang' => 'Nama Barang',
            'jumlah' => 'Jumlah',
        ];
    }
    public function getData()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'id_data']);
    }
    public function getJens()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'jenis']);
    }
}

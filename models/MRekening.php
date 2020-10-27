<?php
namespace app\models;
use Yii;
class MRekening extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'm_rekening';
    }
    public function rules()
    {
        return [
            [['id_data', 'bank_id', 'nomor_rekening'], 'required'],
            [['id_data', 'bank_id'], 'default', 'value' => null],
            [['id_data', 'bank_id'], 'integer'],
            [['nomor_rekening', 'fotoNpwp', 'fotoRekening'], 'string', 'max' => 255],
            [['npwp'], 'string', 'max' => 100],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
            [['bank_id'], 'exist', 'skipOnError' => true, 'targetClass' => MReferensi::className(), 'targetAttribute' => ['bank_id' => 'reff_id']],
            [['fotoNpwp', 'fotoRekening'], 'file', 'extensions' => 'jpg,png,jpeg,gif', 'skipOnEmpty' => false]
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data' => 'Karyawan',
            'bank_id' => 'Nama Bank',
            'nomor_rekening' => 'Nomor Rekening',
            'npwp' => 'Npwp',
            'fotoNpwp' => 'Foto Npwp',
            'fotoRekening' => 'Foto Rekening',
        ];
    }
    public function getData()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'id_data']);
    }
    public function getBank()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'bank_id']);
    }
}
l
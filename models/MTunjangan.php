<?php
namespace app\models;
use Yii;
class MTunjangan extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'm_tunjangan';
    }
    public function rules()
    {
        return [
            [['tunjangan_id', 'id_data'], 'default', 'value' => null],
            [['tunjangan_id', 'id_data'], 'integer'],
            [['nominal'], 'number'],
            [['status'], 'string'],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
            [['tunjangan_id'], 'exist', 'skipOnError' => true, 'targetClass' => MReferensi::className(), 'targetAttribute' => ['tunjangan_id' => 'reff_id']],
            [['nominal'], 'match' ,'pattern'=>'/^[0-9]+$/u', 'message'=> 'Contain only numeric characters.']
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tunjangan_id' => 'Jenis Tunjangan',
            'nominal' => 'Nominal',
            'status' => 'Status',
            'id_data' => 'Nama Pegawai',
        ];
    }
    public function getData()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'id_data']);
    }
    public function getTunjangan()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'tunjangan_id']);
    }
}

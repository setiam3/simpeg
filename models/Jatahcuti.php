<?php
namespace app\models;
use Yii;
class Jatahcuti extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'jatahcuti';
    }
    public function rules()
    {
        return [
            [['id_data', 'jumlah', 'sisa'], 'required'],
            [['id_data', 'jumlah', 'sisa'], 'default', 'value' => null],
            [['id_data', 'jumlah', 'sisa'], 'integer'],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data' => 'Id Data',
            'jumlah' => 'Jumlah',
            'sisa' => 'Sisa',
        ];
    }
    public function getData()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'id_data']);
    }
}

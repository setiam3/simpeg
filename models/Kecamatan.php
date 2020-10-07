<?php
namespace app\models;
use Yii;
class Kecamatan extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'districts';
    }
    public function rules()
    {
        return [
            [['id', 'regency_id', 'name'], 'required'],
            [['id'], 'string', 'max' => 7],
            [['regency_id'], 'string', 'max' => 4],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['regency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupaten::className(), 'targetAttribute' => ['regency_id' => 'id']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'regency_id' => 'Regency ID',
            'name' => 'Name',
        ];
    }
    public function getRegency()
    {
        return $this->hasOne(Kabupaten::className(), ['id' => 'regency_id']);
    }
    public function getVillages()
    {
        return $this->hasMany(Kelurahan::className(), ['district_id' => 'id']);
    }
}

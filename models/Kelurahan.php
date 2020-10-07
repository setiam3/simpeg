<?php
namespace app\models;
use Yii;
class Kelurahan extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'villages';
    }
    public function rules()
    {
        return [
            [['id', 'district_id', 'name'], 'required'],
            [['id'], 'string', 'max' => 10],
            [['district_id'], 'string', 'max' => 7],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['district_id' => 'id']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'district_id' => 'District ID',
            'name' => 'Name',
        ];
    }
    public function getDistrict()
    {
        return $this->hasOne(Kecamatan::className(), ['id' => 'district_id']);
    }
}

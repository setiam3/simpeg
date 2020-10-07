<?php
namespace app\models;
use Yii;
class Propinsi extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'provinces';
    }
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
    public function getRegencies()
    {
        return $this->hasMany(Regencies::className(), ['province_id' => 'id']);
    }
}

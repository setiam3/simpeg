<?php
namespace app\models;
use Yii;
class Kabupaten extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'regencies';
    }
    public function rules()
    {
        return [
            [['id', 'province_id', 'name'], 'required'],
            [['id'], 'string', 'max' => 4],
            [['province_id'], 'string', 'max' => 2],
            [['name', 'alias'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'province_id' => 'Province ID',
            'name' => 'Name',
            'alias' => 'Alias',
        ];
    }
    public function getDistricts()
    {
        return $this->hasMany(Kecamatan::className(), ['regency_id' => 'id']);
    }

}

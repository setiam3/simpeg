<?php
namespace app\models;
use Yii;
class MReffTipe extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'm_reff_tipe';
    }
    public function rules()
    {
        return [
            [['nama_reff_tipe', 'status'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'tipereff_id' => 'Tipereff ID',
            'nama_reff_tipe' => 'Nama Reff Tipe',
            'status' => 'Status',
        ];
    }
    public function getMReferensis()
    {
        return $this->hasMany(MReferensi::className(), ['tipe_referensi' => 'tipereff_id']);
    }
}

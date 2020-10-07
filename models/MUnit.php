<?php
namespace app\models;
use Yii;
class MUnit extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'm_unit';
    }
    public function rules()
    {
        return [
            [['is_vip', 'aktif'], 'default', 'value' => null],
            [['is_vip', 'aktif'], 'integer'],
            [['kode', 'fk_instalasi'], 'string', 'max' => 200],
            [['unit'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'unit' => 'Unit',
            'fk_instalasi' => 'Fk Instalasi',
            'is_vip' => 'Is Vip',
            'aktif' => 'Aktif',
        ];
    }
    public function getRiwayatjabatans()
    {
        return $this->hasMany(Riwayatjabatan::className(), ['unit_kerja' => 'id']);
    }
}

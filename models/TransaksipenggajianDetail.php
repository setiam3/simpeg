<?php
namespace app\models;
use Yii;
class TransaksipenggajianDetail extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'transaksipenggajian_detail';
    }
    public function rules()
    {
        return [
            [['transgaji_id', 'gol_gaji', 'tunjangan_id'], 'default', 'value' => null],
            [['transgaji_id', 'gol_gaji', 'tunjangan_id'], 'integer'],
            [['nominal_val'], 'number'],
            [['tunjangan_id'], 'exist', 'skipOnError' => true, 'targetClass' => MTunjangan::className(), 'targetAttribute' => ['tunjangan_id' => 'id']],
            [['gol_gaji'], 'exist', 'skipOnError' => true, 'targetClass' => Penggolongangaji::className(), 'targetAttribute' => ['gol_gaji' => 'id']],
            [['transgaji_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransaksiPenggajian::className(), 'targetAttribute' => ['transgaji_id' => 'transgaji_id']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'transgajidetail_id' => 'Transgajidetail ID',
            'transgaji_id' => 'Transgaji ID',
            'gol_gaji' => 'Gol Gaji',
            'tunjangan_id' => 'Tunjangan ID',
            'nominal_val' => 'Nominal Val',
        ];
    }
    public function getTunjangan()
    {
        return $this->hasOne(MTunjangan::className(), ['id' => 'tunjangan_id']);
    }
    public function getGolGaji()
    {
        return $this->hasOne(Penggolongangaji::className(), ['id' => 'gol_gaji']);
    }
    public function getTransgaji()
    {
        return $this->hasOne(TransaksiPenggajian::className(), ['transgaji_id' => 'transgaji_id']);
    }
    public function getTransdetail()
    {
        return $this->hasMany(TransaksiPenggajian::className(), ['transgaji_id' => 'transgaji_id']);
    }
}

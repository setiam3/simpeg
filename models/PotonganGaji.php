<?php
namespace app\models;
use Yii;
class PotonganGaji extends \yii\db\ActiveRecord
{
    public $potong;
    public static function tableName()
    {
        return 'potongan_gaji';
    }
    public function rules()
    {
        return [
            [['transgaji_id','potong', 'potongan_desc'], 'default', 'value' => null],
            [['transgaji_id'], 'integer'],
            [['potongan_nominal'], 'number'],
            [['keterangan','potongan_desc'], 'string', 'max' => 255],
            [['transgaji_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransaksiPenggajian::className(), 'targetAttribute' => ['transgaji_id' => 'transgaji_id']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'potongan_id' => 'Potongan ID',
            'transgaji_id' => 'Transgaji ID',
            'potongan_desc' => 'Potongan Desc',
            'potongan_nominal' => 'Potongan Nominal',
            'keterangan' => 'Keterangan',
            'potong' => 'Potong',
        ];
    }
    public function getTransgaji()
    {
        return $this->hasOne(TransaksiPenggajian::className(), ['transgaji_id' => 'transgaji_id']);
    }
}

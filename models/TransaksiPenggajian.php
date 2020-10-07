<?php
namespace app\models;
use Yii;
class TransaksiPenggajian extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'transaksi_penggajian';
    }
    public function rules()
    {
        return [
            [['tgl_gaji', 'tgl_input'], 'safe'],
            [['data_id', 'pelaksana_id'], 'default', 'value' => null],
            [['data_id', 'pelaksana_id'], 'integer'],
            [['total_brutto_gaji', 'total_bersih_gaji'], 'number'],
            [['nomor_transgaji'], 'string', 'max' => 20],
            [['data_id'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['data_id' => 'id_data']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'transgaji_id' => 'Transgaji ID',
            'nomor_transgaji' => 'Nomor Transgaji',
            'tgl_gaji' => 'Tgl Gaji',
            'data_id' => 'Nama Pegawai',
            'pelaksana_id' => 'Pelaksana ID',
            'tgl_input' => 'Tgl Input',
            'total_brutto_gaji' => 'Total Brutto Gaji',
            'total_bersih_gaji' => 'Total Bersih Gaji',
        ];
    }
    public function getPotongangajis()
    {
        return $this->hasMany(PotonganGaji::className(), ['transgaji_id' => 'transgaji_id']);
    }
    public function getPotongangajiss()
    {
        return $this->hasOne(PotonganGaji::className(), ['transgaji_id' => 'transgaji_id']);
    }
    public function getData()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'data_id']);
    }
    public function getTrandetail()
    {
        return $this->hasMany(TransaksipenggajianDetail::className(), ['transgaji_id' => 'transgaji_id']);
    }
    public function getTransdetail()
    {
        return $this->hasOne(TransaksipenggajianDetail::className(), ['transgaji_id' => 'transgaji_id']);
    }
}

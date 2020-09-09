<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaksi_penggajian".
 *
 * @property int $transgaji_id
 * @property string|null $nomor_transgaji
 * @property string|null $tgl_gaji
 * @property int|null $data_id
 * @property int|null $pelaksana_id
 * @property string|null $tgl_input
 * @property float|null $total_brutto_gaji
 * @property float|null $total_bersih_gaji
 *
 * @property PotonganGaji[] $potonganGajis
 * @property MBiodata $data
 * @property TransaksipenggajianDetail[] $transaksipenggajianDetails
 */
class TransaksiPenggajian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_penggajian';
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'transgaji_id' => 'Transgaji ID',
            'nomor_transgaji' => 'Nomor Transgaji',
            'tgl_gaji' => 'Tgl Gaji',
            'data_id' => 'Nama',
            'pelaksana_id' => 'Pelaksana ID',
            'tgl_input' => 'Tgl Input',
            'total_brutto_gaji' => 'Total Brutto Gaji',
            'total_bersih_gaji' => 'Total Bersih Gaji',
        ];
    }

    /**
     * Gets query for [[PotonganGajis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPotongangajis()
    {
        return $this->hasMany(PotonganGaji::className(), ['transgaji_id' => 'transgaji_id']);
    }

    /**
     * Gets query for [[Data]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getData()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'data_id']);
    }

    /**
     * Gets query for [[TransaksipenggajianDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
<<<<<<< HEAD
     public function getTransaksipenggajianDetails()
     {
         return $this->hasMany(TransaksipenggajianDetail::className(), ['transgaji_id' => 'transgaji_id']);
     }
=======
    public function getTrandetail()
    {
        return $this->hasMany(TransaksipenggajianDetail::className(), ['transgaji_id' => 'transgaji_id']);
    }
>>>>>>> 24c159bcdcaa6b604ffe174d81f4a954ddbeded0
}

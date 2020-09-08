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
 * 
 * @property int $transgajidetail_id
 * @property int|null $gol_gaji
 * @property int|null $tunjangan_id
 * @property float|null $nominal_val
 *
 * @property MTunjangan $tunjangan
 * @property Penggolongangaji $golGaji
 * @property TransaksiPenggajian $transgaji
 * 
 * @property int $potongan_id
 * @property int|null $potongan_desc
 * @property float|null $potongan_nominal
 * @property string|null $keterangan
 *
 * @property MReferensi $potonganDesc
 * @property TransaksiPenggajian $transgaji
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
            [['tgl_gaji', 'tgl_input', 'gol_gaji', 'tunjangan_id'], 'safe'],
            [['data_id', 'pelaksana_id', 'potongan_desc'], 'default', 'value' => null],
            [['data_id', 'pelaksana_id', 'gol_gaji', 'tunjangan_id', 'potongan_desc'], 'integer'],
            [['total_brutto_gaji', 'total_bersih_gaji', 'nominal_val', 'potongan_nominal'], 'number'],
            [['nomor_transgaji', 'keterangan'], 'string', 'max' => 20],
            [['data_id'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['data_id' => 'id_data']],
            [['tunjangan_id'], 'exist', 'skipOnError' => true, 'targetClass' => MTunjangan::className(), 'targetAttribute' => ['tunjangan_id' => 'id']],
            [['gol_gaji'], 'exist', 'skipOnError' => true, 'targetClass' => Penggolongangaji::className(), 'targetAttribute' => ['gol_gaji' => 'id']],
            [['potongan_desc'], 'exist', 'skipOnError' => true, 'targetClass' => MReferensi::className(), 'targetAttribute' => ['potongan_desc' => 'reff_id']],

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
            'data_id' => 'Data ID',
            'pelaksana_id' => 'Pelaksana ID',
            'tgl_input' => 'Tgl Input',
            'total_brutto_gaji' => 'Total Brutto Gaji',
            'total_bersih_gaji' => 'Total Bersih Gaji',
            'transgajidetail_id' => 'Transgajidetail ID',
            'gol_gaji' => 'Gol Gaji',
            'tunjangan_id' => 'Tunjangan ID',
            'nominal_val' => 'Nominal Val',
            'potongan_id' => 'Potongan ID',
            'potongan_desc' => 'Potongan Desc',
            'potongan_nominal' => 'Potongan Nominal',
            'keterangan' => 'Keterangan',
        ];
    }
}

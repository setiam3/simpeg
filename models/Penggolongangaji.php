<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penggolongangaji".
 *
 * @property int $id
 * @property int $pangkat_id
 * @property int|null $masa_kerja
 * @property string $gaji
 * @property string|null $status_penggolongan
 * @property string|null $ruang
 * @property int|null $jenis_pegawai
 *
 * @property Kepangkatan[] $kepangkatans
 * @property MReferensi $pangkat
 * @property MReferensi $jenisPegawai
 * @property TransaksipenggajianDetail[] $transaksipenggajianDetails
 */
class Penggolongangaji extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penggolongangaji';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pangkat_id', 'gaji'], 'required'],
            [['pangkat_id', 'masa_kerja', 'jenis_pegawai'], 'default', 'value' => null],
            [['pangkat_id', 'masa_kerja', 'jenis_pegawai'], 'integer'],
            [['ruang'], 'string'],
            [['gaji', 'status_penggolongan'], 'string', 'max' => 255],
            [['pangkat_id'], 'exist', 'skipOnError' => true, 'targetClass' => MReferensi::className(), 'targetAttribute' => ['pangkat_id' => 'reff_id']],
            [['jenis_pegawai'], 'exist', 'skipOnError' => true, 'targetClass' => MReferensi::className(), 'targetAttribute' => ['jenis_pegawai' => 'reff_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pangkat_id' => 'Pangkat',
            'masa_kerja' => 'Masa Kerja',
            'gaji' => 'Gaji',
            'status_penggolongan' => 'Status Penggolongan',
            'ruang' => 'Ruang',
            'jenis_pegawai' => 'Jenis Pegawai',
        ];
    }

    /**
     * Gets query for [[Kepangkatans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKepangkatans()
    {
        return $this->hasMany(Kepangkatan::className(), ['penggolongangaji_id' => 'id']);
    }

    /**
     * Gets query for [[Pangkat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPangkat()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'pangkat_id']);
    }

    /**
     * Gets query for [[JenisPegawai]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJenisPegawai()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'jenis_pegawai']);
    }

    /**
     * Gets query for [[TransaksipenggajianDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksipenggajianDetails()
    {
        return $this->hasMany(TransaksipenggajianDetail::className(), ['gol_gaji' => 'id']);
    }
}

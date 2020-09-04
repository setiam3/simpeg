<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_referensi".
 *
 * @property int $reff_id
 * @property string|null $nama_referensi
 * @property int|null $tipe_referensi
 * @property string|null $status
 *
 * @property MBiodata[] $mBiodatas
 * @property MReffTipe $tipeReferensi
 * @property Penggolongangaji[] $penggolongangajis
 * @property Penggolongangaji[] $penggolongangajis0
 * @property Riwayatjabatan[] $riwayatjabatans
 */
class MReferensi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_referensi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipe_referensi'], 'default', 'value' => null],
            [['tipe_referensi'], 'integer'],
            [['nama_referensi', 'status'], 'string', 'max' => 255],
            [['tipe_referensi'], 'exist', 'skipOnError' => true, 'targetClass' => MReffTipe::className(), 'targetAttribute' => ['tipe_referensi' => 'tipereff_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'reff_id' => 'Reff ID',
            'nama_referensi' => 'Nama Referensi',
            'tipe_referensi' => 'Tipe Referensi',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[MBiodatas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMBiodatas()
    {
        return $this->hasMany(MBiodata::className(), ['status_hubungan_keluarga' => 'reff_id']);
    }

    /**
     * Gets query for [[TipeReferensi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipeReferensi()
    {
        return $this->hasOne(MReffTipe::className(), ['tipereff_id' => 'tipe_referensi']);
    }

    /**
     * Gets query for [[Penggolongangajis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenggolongangajis()
    {
        return $this->hasMany(MPenggolongangaji::className(), ['pangkat_id' => 'reff_id']);
    }

    /**
     * Gets query for [[Penggolongangajis0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenggolongangajis0()
    {
        return $this->hasMany(Penggolongangaji::className(), ['golongan_id' => 'reff_id']);
    }

    /**
     * Gets query for [[Riwayatjabatans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRiwayatjabatans()
    {
        return $this->hasMany(Riwayatjabatan::className(), ['id_jabatan' => 'reff_id']);
    }
}

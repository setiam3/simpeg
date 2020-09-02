<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_checklog_pegawai".
 *
 * @property string $checklogpegawai_id
 * @property int $id_data
 * @property string|null $nama_checklogpegawai
 * @property string|null $status_checklogpegawai
 * @property string|null $nip
 *
 * @property ChecklogPegawai[] $checklogPegawais
 * @property MBiodata[] $mBiodatas
 * @property MBiodata $data
 */
class MmasterchecklogPegawai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_checklog_pegawai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['checklogpegawai_id', 'id_data'], 'required'],
            [['id_data'], 'default', 'value' => null],
            [['id_data'], 'integer'],
            [['checklogpegawai_id'], 'string', 'max' => 50],
            [['nama_checklogpegawai'], 'string', 'max' => 200],
            [['status_checklogpegawai'], 'string', 'max' => 10],
            [['nip'], 'string', 'max' => 100],
            [['checklogpegawai_id'], 'unique'],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'checklogpegawai_id' => 'Checklogpegawai ID',
            'id_data' => 'Id Data',
            'nama_checklogpegawai' => 'Nama Checklogpegawai',
            'status_checklogpegawai' => 'Status Checklogpegawai',
            'nip' => 'Nip',
        ];
    }

    /**
     * Gets query for [[ChecklogPegawais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChecklogPegawais()
    {
        return $this->hasMany(ChecklogPegawai::className(), ['checklogpegawai_id' => 'checklogpegawai_id']);
    }

    /**
     * Gets query for [[MBiodatas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMBiodatas()
    {
        return $this->hasMany(MBiodata::className(), ['checklog_id' => 'checklogpegawai_id']);
    }

    /**
     * Gets query for [[Data]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getData()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'id_data']);
    }
}

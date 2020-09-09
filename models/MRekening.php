<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_rekening".
 *
 * @property int $id
 * @property int $id_data
 * @property int $bank_id
 * @property string $nomor_rekening
 * @property string|null $npwp
 * @property string|null $fotoNpwp
 * @property string|null $fotoRekening
 *
 * @property MBiodata $data
 * @property MReferensi $bank
 */
class MRekening extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_rekening';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_data', 'bank_id', 'nomor_rekening'], 'required'],
            [['id_data', 'bank_id'], 'default', 'value' => null],
            [['id_data', 'bank_id'], 'integer'],
            [['nomor_rekening', 'fotoNpwp', 'fotoRekening'], 'string', 'max' => 255],
            [['npwp'], 'string', 'max' => 100],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
            [['bank_id'], 'exist', 'skipOnError' => true, 'targetClass' => MReferensi::className(), 'targetAttribute' => ['bank_id' => 'reff_id']],
            [['fotoNpwp', 'fotoRekening'], 'file', 'extensions' => 'jpg,png,jpeg,gif', 'skipOnEmpty' => false]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data' => 'Karyawan',
            'bank_id' => 'Nama Bank',
            'nomor_rekening' => 'Nomor Rekening',
            'npwp' => 'Npwp',
            'fotoNpwp' => 'Foto Npwp',
            'fotoRekening' => 'Foto Rekening',
        ];
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

    /**
     * Gets query for [[Bank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'bank_id']);
    }
}

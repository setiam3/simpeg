<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_tunjangan".
 *
 * @property int $id
 * @property int|null $tunjangan_id
 * @property float|null $nominal
 * @property string|null $status
 * @property int|null $id_data
 *
 * @property MBiodata $data
 * @property MReferensi $tunjangan
 */
class MTunjangan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_tunjangan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tunjangan_id', 'id_data'], 'default', 'value' => null],
            [['tunjangan_id', 'id_data'], 'integer'],
            [['nominal'], 'number'],
            [['status'], 'string'],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
            [['tunjangan_id'], 'exist', 'skipOnError' => true, 'targetClass' => MReferensi::className(), 'targetAttribute' => ['tunjangan_id' => 'reff_id']],
            [['nominal'], 'match' ,'pattern'=>'/^[0-9]+$/u', 'message'=> 'Contain only numeric characters.']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tunjangan_id' => 'Jenis Tunjangan',
            'nominal' => 'Nominal',
            'status' => 'Status',
            'id_data' => 'Nama Pegawai',
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
     * Gets query for [[Tunjangan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTunjangan()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'tunjangan_id']);
    }
}

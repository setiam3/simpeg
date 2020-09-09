<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "riwayatdiklat".
 *
 * @property int $id
 * @property int $id_data
 * @property string $namaDiklat
 * @property string $tempat
 * @property string $penyelenggara
 * @property string $mulai
 * @property string $selesai
 * @property string|null $dokumen
 *
 * @property MBiodata $data
 */
class Riwayatdiklat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'riwayatdiklat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_data', 'namaDiklat', 'tempat', 'penyelenggara', 'mulai', 'selesai'], 'required'],
            [['id_data'], 'default', 'value' => null],
            [['id_data'], 'integer'],
            [['mulai', 'selesai'], 'safe'],
            [['namaDiklat', 'tempat', 'penyelenggara', 'dokumen'], 'string', 'max' => 255],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data' => 'Nama',
            'namaDiklat' => 'Nama Diklat',
            'tempat' => 'Tempat',
            'penyelenggara' => 'Penyelenggara',
            'mulai' => 'Mulai',
            'selesai' => 'Selesai',
            'dokumen' => 'Dokumen',
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
}

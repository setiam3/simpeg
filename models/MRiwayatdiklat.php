<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "riwayatdiklat".
 *
 * @property int $id
 * @property string $nip
 * @property string $namaDiklat
 * @property string $tempat
 * @property string $penyelenggara
 * @property string $mulai
 * @property string $selesai
 */
class MRiwayatdiklat extends \yii\db\ActiveRecord
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
            [['nip', 'namaDiklat', 'tempat', 'penyelenggara', 'mulai', 'selesai'], 'required'],
            [['mulai', 'selesai'], 'safe'],
            [['nip'], 'string', 'max' => 20],
            [['namaDiklat', 'tempat', 'penyelenggara'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nip' => 'Nip',
            'namaDiklat' => 'Nama Diklat',
            'tempat' => 'Tempat',
            'penyelenggara' => 'Penyelenggara',
            'mulai' => 'Mulai',
            'selesai' => 'Selesai',
        ];
    }
}

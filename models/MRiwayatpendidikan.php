<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "riwayatpendidikan".
 *
 * @property int $id
 * @property string $nip
 * @property string $tingkatPendidikan
 * @property string $jurusan
 * @property string $namaSekolah
 * @property string $thLulus
 */
class MRiwayatpendidikan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'riwayatpendidikan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nip', 'tingkatPendidikan', 'namaSekolah', 'thLulus'], 'required'],
            [['nip'], 'string', 'max' => 20],
            [['tingkatPendidikan', 'jurusan', 'namaSekolah'], 'string', 'max' => 255],
            [['thLulus'], 'string', 'max' => 4],
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
            'tingkatPendidikan' => 'Tingkat Pendidikan',
            'jurusan' => 'Jurusan',
            'namaSekolah' => 'Nama Sekolah',
            'thLulus' => 'Th Lulus',
        ];
    }
}

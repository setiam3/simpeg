<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "riwayatpendidikan".
 *
 * @property int $id
 * @property int $id_data
 * @property string $tingkatPendidikan
 * @property string|null $jurusan
 * @property string $namaSekolah
 * @property string $thLulus
 * @property string|null $dokumen
 *
 * @property MBiodata $data
 */
class Riwayatpendidikan extends \yii\db\ActiveRecord
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
            [['id_data', 'tingkatPendidikan', 'namaSekolah', 'thLulus'], 'required'],
            [['id_data'], 'default', 'value' => null],
            [['id_data'], 'integer'],
            [['tingkatPendidikan', 'jurusan', 'namaSekolah', 'dokumen'], 'string', 'max' => 255],
            [['thLulus'], 'string', 'max' => 4],
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
            'id_data' => 'Id Data',
            'tingkatPendidikan' => 'Tingkat Pendidikan',
            'jurusan' => 'Jurusan',
            'namaSekolah' => 'Nama Sekolah',
            'thLulus' => 'Th Lulus',
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

    public function getPendidikan()
    {
        return $this->hasOne(MReferensi::className(), [ 'reff_id' => 'tingkatPendidikan']);
    }
}

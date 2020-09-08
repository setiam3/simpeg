<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "riwayatpendidikan".
 *
 * @property int $id
 * @property int $id_data
 * @property int $tingkatPendidikan
 * @property string|null $jurusan
 * @property string|null $namaSekolah
 * @property string|null $thLulus
 * @property string|null $dokumen
 * @property string|null $no_ijazah
 * @property string|null $tgl_ijazah
 * @property string|null $thMasuk
 * @property int|null $medis
 * @property string|null $suratijin
 * @property string|null $tgl_berlaku_ijin
 *
 * @property MBiodata $data
 * @property MReferensi $tingkatPendidikan0
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
            [['id_data', 'tingkatPendidikan'], 'required'],
            [['id_data', 'tingkatPendidikan', 'medis'], 'default', 'value' => null],
            [['id_data', 'tingkatPendidikan', 'medis'], 'integer'],
            [['tgl_ijazah', 'tgl_berlaku_ijin'], 'safe'],
            [['suratijin'], 'string'],
            [['jurusan', 'namaSekolah', 'dokumen'], 'string', 'max' => 255],
            [['thLulus', 'thMasuk'], 'string', 'max' => 4],
            [['no_ijazah'], 'string', 'max' => 100],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
            [['tingkatPendidikan'], 'exist', 'skipOnError' => true, 'targetClass' => MReferensi::className(), 'targetAttribute' => ['tingkatPendidikan' => 'reff_id']],
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
            'no_ijazah' => 'No Ijazah',
            'tgl_ijazah' => 'Tgl Ijazah',
            'thMasuk' => 'Th Masuk',
            'medis' => 'Medis',
            'suratijin' => 'Suratijin',
            'tgl_berlaku_ijin' => 'Tgl Berlaku Ijin',
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
     * Gets query for [[TingkatPendidikan0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTingkatPendidikan()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'tingkatPendidikan']);
    }
}

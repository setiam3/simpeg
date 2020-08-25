<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_biodata".
 *
 * @property int $id
 * @property string $nama
 * @property string $tempatLahir
 * @property string $tanggalLahir
 * @property string $alamat
 * @property string $kabupatenKota
 * @property string $kecamatan
 * @property string $kelurahan
 * @property string $jenisKelamin
 * @property string $agama
 * @property string $telp
 * @property string $email
 * @property string $statusPerkawinan
 * @property string $gelarDepan
 * @property string $gelarBelakang
 * @property string $nik
 * @property string $foto
 * @property string $fotoNik
 * @property string $golonganDarah
 */
class MBiodata extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_biodata';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'tempatLahir', 'tanggalLahir', 'alamat', 'jenisKelamin', 'agama', 'nik'], 'required'],
            [['tanggalLahir'], 'safe'],
            [['nama', 'alamat', 'kabupatenKota', 'kecamatan', 'kelurahan', 'jenisKelamin', 'email', 'foto', 'fotoNik'], 'string', 'max' => 255],
            [['tempatLahir', 'agama'], 'string', 'max' => 200],
            [['telp', 'nik'], 'string', 'max' => 20],
            [['statusPerkawinan', 'gelarDepan', 'gelarBelakang'], 'string', 'max' => 100],
            [['golonganDarah'], 'string', 'max' => 2],
            ['email','email'],
            ['email', 'unique'],
            [['foto','fotoNik'], 'file', 'extensions' => ['jpeg','png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'tempatLahir' => 'Tempat Lahir',
            'tanggalLahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'kabupatenKota' => 'Kabupaten Kota',
            'kecamatan' => 'Kecamatan',
            'kelurahan' => 'Kelurahan',
            'jenisKelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'telp' => 'Telp',
            'email' => 'Email',
            'statusPerkawinan' => 'Status Perkawinan',
            'gelarDepan' => 'Gelar Depan',
            'gelarBelakang' => 'Gelar Belakang',
            'nik' => 'Nik',
            'foto' => 'Foto',
            'fotoNik' => 'Foto Nik',
            'golonganDarah' => 'Golongan Darah',
        ];
    }
}

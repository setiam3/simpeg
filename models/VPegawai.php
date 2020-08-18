<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai".
 *
 * @property int $id
 * @property string $nip
 * @property string $statusPegawai
 * @property int $status
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
 * @property string $npwp
 * @property string $foto
 */
class VPegawai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['nip', 'statusPegawai', 'status', 'nama', 'tempatLahir', 'tanggalLahir', 'alamat', 'jenisKelamin', 'agama', 'nik'], 'required'],
            [['tanggalLahir'], 'safe'],
            [['nip', 'telp', 'nik', 'npwp'], 'string', 'max' => 20],
            [['statusPegawai', 'nama', 'alamat', 'kabupatenKota', 'kecamatan', 'kelurahan', 'jenisKelamin', 'email', 'foto'], 'string', 'max' => 255],
            [['tempatLahir', 'agama'], 'string', 'max' => 200],
            [['statusPerkawinan', 'gelarDepan', 'gelarBelakang'], 'string', 'max' => 100],
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
            'statusPegawai' => 'Status Pegawai',
            'status' => 'Status',
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
            'npwp' => 'Npwp',
            'foto' => 'Foto',
        ];
    }
}

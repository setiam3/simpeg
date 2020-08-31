<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_biodata".
 *
 * @property int $id_data
 * @property int|null $parent_id
 * @property string|null $nip
 * @property string $nama
 * @property string $tempatLahir
 * @property string $tanggalLahir
 * @property string $alamat
 * @property string|null $kabupatenKota
 * @property string|null $kecamatan
 * @property string|null $kelurahan
 * @property string $jenisKelamin
 * @property string $agama
 * @property string|null $telp
 * @property string|null $email
 * @property string|null $statusPerkawinan
 * @property string|null $gelarDepan
 * @property string|null $gelarBelakang
 * @property string $nik
 * @property string|null $foto
 * @property string|null $fotoNik
 * @property string|null $golonganDarah
 * @property int|null $status_hubungan_keluarga
 * @property string|null $is_pegawai
 * @property string|null $statusPegawai
 *
 * @property Kepangkatan[] $kepangkatans
 * @property MBiodata $parent
 * @property MBiodata[] $mBiodatas
 * @property MReferensi $statusHubunganKeluarga
 * @property Pinjaman[] $pinjamen
 * @property Riwayatdiklat[] $riwayatdiklats
 * @property Riwayatjabatan[] $riwayatjabatans
 * @property Riwayatpendidikan[] $riwayatpendidikans
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
            [['parent_id', 'status_hubungan_keluarga'], 'default', 'value' => null],
            [['parent_id', 'status_hubungan_keluarga'], 'integer'],
            [['nama', 'tempatLahir', 'tanggalLahir', 'alamat', 'jenisKelamin', 'agama', 'nik'], 'required'],
            [['tanggalLahir'], 'safe'],
            [['statusPegawai'], 'string'],
            [['nip', 'nama', 'alamat', 'kabupatenKota', 'kecamatan', 'kelurahan', 'jenisKelamin', 'email', 'foto', 'fotoNik', 'is_pegawai'], 'string', 'max' => 255],
            [['tempatLahir', 'agama'], 'string', 'max' => 200],
            [['telp', 'nik'], 'string', 'max' => 20],
            [['statusPerkawinan', 'gelarDepan', 'gelarBelakang'], 'string', 'max' => 100],
            [['golonganDarah'], 'string', 'max' => 2],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['parent_id' => 'id_data']],
            [['status_hubungan_keluarga'], 'exist', 'skipOnError' => true, 'targetClass' => MReferensi::className(), 'targetAttribute' => ['status_hubungan_keluarga' => 'reff_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_data' => 'Id Data',
            'parent_id' => 'Parent ID',
            'nip' => 'Nip',
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
            'status_hubungan_keluarga' => 'Status Hubungan Keluarga',
            'is_pegawai' => 'Is Pegawai',
            'statusPegawai' => 'Status Pegawai',
        ];
    }

    /**
     * Gets query for [[Kepangkatans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKepangkatans()
    {
        return $this->hasMany(Kepangkatan::className(), ['id_data' => 'id_data']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'parent_id']);
    }

    /**
     * Gets query for [[MBiodatas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMBiodatas()
    {
        return $this->hasMany(MBiodata::className(), ['parent_id' => 'id_data']);
    }

    /**
     * Gets query for [[StatusHubunganKeluarga]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusHubunganKeluarga()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'status_hubungan_keluarga']);
    }

    /**
     * Gets query for [[Pinjamen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPinjamen()
    {
        return $this->hasMany(Pinjaman::className(), ['id_data' => 'id_data']);
    }

    /**
     * Gets query for [[Riwayatdiklats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRiwayatdiklats()
    {
        return $this->hasMany(Riwayatdiklat::className(), ['id_data' => 'id_data']);
    }

    /**
     * Gets query for [[Riwayatjabatans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRiwayatjabatans()
    {
        return $this->hasMany(Riwayatjabatan::className(), ['id_data' => 'id_data']);
    }

    /**
     * Gets query for [[Riwayatpendidikans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRiwayatpendidikans()
    {
        return $this->hasMany(Riwayatpendidikan::className(), ['id_data' => 'id_data']);
    }
}

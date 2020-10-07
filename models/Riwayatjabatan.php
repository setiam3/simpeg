<?php
namespace app\models;
use Yii;
class Riwayatjabatan extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'riwayatjabatan';
    }
    public function rules()
    {
        return [
            [['id_data', 'id_jabatan', 'noSk', 'tglSk', 'tmtJabatan'], 'required'],
            [['id_data', 'id_jabatan', 'unit_kerja'], 'default', 'value' => null],
            [['id_data', 'id_jabatan', 'unit_kerja'], 'integer'],
            [['tglSk', 'tmtJabatan'], 'safe'],
            [['eselon', 'noSk', 'dokumen'], 'string', 'max' => 255],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
            [['id_jabatan'], 'exist', 'skipOnError' => true, 'targetClass' => MReferensi::className(), 'targetAttribute' => ['id_jabatan' => 'reff_id']],
            [['unit_kerja'], 'exist', 'skipOnError' => true, 'targetClass' => MUnit::className(), 'targetAttribute' => ['unit_kerja' => 'id']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data' => 'Nama Pegawai',
            'id_jabatan' => 'Jabatan',
            'eselon' => 'Eselon',
            'noSk' => 'No Sk',
            'tglSk' => 'Tgl Sk',
            'tmtJabatan' => 'Tmt Jabatan',
            'dokumen' => 'Dokumen',
            'unit_kerja' => 'Unit Kerja',
        ];
    }
    public function getData()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'id_data']);
    }
    public function getJabatan()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'id_jabatan']);
    }
    public function getUnitKerja()
    {
        return $this->hasOne(MUnit::className(), ['id' => 'unit_kerja']);
    }
}

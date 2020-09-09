<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "riwayatjabatan".
 *
 * @property int $id
 * @property int $id_data
 * @property int $id_jabatan
 * @property string|null $eselon
 * @property string $noSk
 * @property string $tglSk
 * @property string $tmtJabatan
 * @property string|null $dokumen
 * @property int|null $unit_kerja
 *
 * @property MBiodata $data
 * @property MReferensi $jabatan
 * @property MUnit $unitKerja
 */
class Riwayatjabatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'riwayatjabatan';
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data' => 'Karyawan',
            'id_jabatan' => 'Jabatan',
            'eselon' => 'Eselon',
            'noSk' => 'No Sk',
            'tglSk' => 'Tgl Sk',
            'tmtJabatan' => 'Tmt Jabatan',
            'dokumen' => 'Dokumen',
            'unit_kerja' => 'Unit Kerja',
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
     * Gets query for [[Jabatan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJabatan()
    {
        return $this->hasOne(MReferensi::className(), ['reff_id' => 'id_jabatan']);
    }

    /**
     * Gets query for [[UnitKerja]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnitKerja()
    {
        return $this->hasOne(MUnit::className(), ['id' => 'unit_kerja']);
    }
}

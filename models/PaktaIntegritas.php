<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pakta_integritas".
 *
 * @property int $id
 * @property string|null $nomer
 * @property int|null $id_data
 * @property string|null $jabatan
 * @property string|null $tanggal
 * @property string|null $ttd
 */
class Paktaintegritas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pakta_integritas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_data'], 'default', 'value' => null],
            [['id_data'], 'integer'],
            [['tanggal'], 'safe'],
            [['ttd'], 'string'],
            [['nomer', 'jabatan'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomer' => 'Nomer',
            'id_data' => 'Id Data',
            'jabatan' => 'Jabatan',
            'tanggal' => 'Tanggal',
            'ttd' => 'Ttd',
        ];
    }
    public function getNamapegawai()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'id_data']);
    }

    public function ttdDirektur(){
        $sql = "SELECT mb.nama,k.ttd,mb.nip FROM ntl_kehadiran k JOIN m_biodata mb on k.peserta = mb.nama 
WHERE k.id_kehadiran = 9";
        return $ttdDIrektur = \Yii::$app->db->createCommand($sql)->queryAll();
    }
}

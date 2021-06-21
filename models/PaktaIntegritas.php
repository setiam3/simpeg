<?php
namespace app\models;
use Yii;
class Paktaintegritas extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'pakta_integritas';
    }
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
        WHERE lower(k.jabatan)='direktur' and k.ttd is not null limit 1";
        return $ttdDIrektur = \Yii::$app->db->createCommand($sql)->queryAll();
    }
}

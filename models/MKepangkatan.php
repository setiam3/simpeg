<?php
namespace app\models;
use Yii;
class MKepangkatan extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'kepangkatan';
    }
    public function rules()
    {
        return [
            [['id_data', 'ditetapkanOleh', 'noSk', 'tglSk', 'penggolongangaji_id', 'tmtPangkat'], 'required'],
            [['id_data', 'penggolongangaji_id', 'fk_golongan'], 'default', 'value' => null],
            [['id_data', 'penggolongangaji_id', 'fk_golongan'], 'integer'],
            [['tglSk', 'tmtPangkat'], 'safe'],
            [['ditetapkanOleh', 'noSk', 'tmt', 'dokumen'], 'string', 'max' => 255],
            [['ruang'], 'string', 'max' => 1],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
            [['penggolongangaji_id'], 'exist', 'skipOnError' => true, 'targetClass' => Penggolongangaji::className(), 'targetAttribute' => ['penggolongangaji_id' => 'id']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data' => 'Nama Pegawai',
            'ditetapkanOleh' => 'Ditetapkan Oleh',
            'noSk' => 'No Sk',
            'tglSk' => 'Tgl Sk',
            'penggolongangaji_id' => 'Golongan',
            'tmtPangkat' => 'Tmt Pangkat',
            'ruang' => 'Ruang',
            'fk_golongan' => 'Fk Golongan',
            'tmt' => 'Tmt',
            'dokumen' => 'Dokumen',
        ];
    }
    public function getData()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'id_data']);
    }
    // public function getPangkat(){
    //     return $this->
    // }
    public function getPenggolongangaji()
    {
        return $this->hasOne(Penggolongangaji::className(), ['id' => 'penggolongangaji_id']);
    }
}

<?php
namespace app\models;
use Yii;
class Pengajuanijin extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'pengajuanijin';
    }
    public function rules()
    {
        return [
            [['tanggalPengajuan', 'tanggalMulai', 'tanggalAkhir', 'alasan', 'id_data', 'jenisIjin'], 'required'],
            [['tanggalPengajuan', 'tanggalMulai', 'tanggalAkhir'], 'safe'],
            [['id_data', 'approval1', 'approval2', 'disetujui'], 'default', 'value' => null],
            [['id_data', 'approval1', 'approval2', 'disetujui'], 'integer'],
            [['alasan', 'jenisIjin','keterangan'], 'string', 'max' => 255],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
            [['approval1'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['approval1' => 'id_data']],
            [['approval2'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['approval2' => 'id_data']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggalPengajuan' => 'Tanggal Pengajuan',
            'tanggalMulai' => 'Tanggal Mulai',
            'tanggalAkhir' => 'Tanggal Akhir',
            'alasan' => 'Alasan',
            'id_data' => 'Nama Pegawai',
            'approval1' => 'Approval1',
            'approval2' => 'Approval2',
            'disetujui' => 'Disetujui',
            'jenisIjin' => 'Jenis Ijin',
            'keterangan'=>'Keterangan'
        ];
    }
    public function getData()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'id_data']);
    }
    public function getApproval10()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'approval1']);
    }
    public function getApproval20()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'approval2']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengajuanijin".
 *
 * @property int $id
 * @property string $tanggalPengajuan
 * @property string $tanggalMulai
 * @property string $tanggalAkhir
 * @property string $alasan
 * @property int $id_data
 * @property int|null $approval1
 * @property int|null $approval2
 * @property int|null $disetujui
 * @property string $jenisIjin
 *
 * @property MBiodata $data
 * @property MBiodata $approval10
 * @property MBiodata $approval20
 */
class Pengajuanijin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pengajuanijin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggalPengajuan', 'tanggalMulai', 'tanggalAkhir', 'alasan', 'id_data', 'jenisIjin'], 'required'],
            [['tanggalPengajuan', 'tanggalMulai', 'tanggalAkhir'], 'safe'],
            [['id_data', 'approval1', 'approval2', 'disetujui'], 'default', 'value' => null],
            [['id_data', 'approval1', 'approval2', 'disetujui'], 'integer'],
            [['alasan', 'jenisIjin'], 'string', 'max' => 255],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
            [['approval1'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['approval1' => 'id_data']],
            [['approval2'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['approval2' => 'id_data']],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
     * Gets query for [[Approval10]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApproval10()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'approval1']);
    }

    /**
     * Gets query for [[Approval20]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApproval20()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'approval2']);
    }
}

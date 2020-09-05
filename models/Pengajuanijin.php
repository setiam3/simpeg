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
 * @property int $disetujui
 * @property string $jenisIjin
 *
 * @property MBiodata $data
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
            [['tanggalPengajuan', 'tanggalMulai', 'tanggalAkhir', 'alasan', 'id_data', 'disetujui', 'jenisIjin'], 'required'],
            [['tanggalPengajuan', 'tanggalMulai', 'tanggalAkhir'], 'safe'],
            [['id_data', 'approval1', 'approval2', 'disetujui'], 'default', 'value' => null],
            [['id_data', 'approval1', 'approval2', 'disetujui'], 'integer'],
            [['alasan', 'jenisIjin'], 'string', 'max' => 255],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
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
            'id_data' => 'Id Data',
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
}

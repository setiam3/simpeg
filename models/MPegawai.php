<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_pegawai".
 *
 * @property int $id
 * @property string $nip
 * @property string $fk_biodata
 * @property string $statusPegawai
 * @property int $status
 */
class MPegawai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_pegawai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nip', 'fk_biodata', 'statusPegawai', 'status'], 'required'],
            [['status'], 'integer'],
            [['nip'], 'string', 'max' => 20],
            [['fk_biodata', 'statusPegawai'], 'string', 'max' => 255],
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
            'fk_biodata' => 'Fk Biodata',
            'statusPegawai' => 'Status Pegawai',
            'status' => 'Status',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kepangkatan".
 *
 * @property int $id
 * @property int $id_data
 * @property string $ditetapkanOleh
 * @property string $noSk
 * @property string $tglSk
 * @property int $penggolongangaji_id
 * @property string $tmtPangkat
 * @property string $ruang
 * @property int $fk_golongan
 * @property string|null $tmt
 * @property string|null $dokumen
 *
 * @property MBiodata $data
 * @property Penggolongangaji $penggolongangaji
 */
class MKepangkatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kepangkatan';
    }

    /**
     * {@inheritdoc}
     */
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
            [['penggolongangaji_id'], 'exist', 'skipOnError' => true, 'targetClass' => MPenggolongangaji::className(), 'targetAttribute' => ['penggolongangaji_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data' => 'Id Data',
            'ditetapkanOleh' => 'Ditetapkan Oleh',
            'noSk' => 'No Sk',
            'tglSk' => 'Tgl Sk',
            'penggolongangaji_id' => 'Penggolongangaji ID',
            'tmtPangkat' => 'Tmt Pangkat',
            'ruang' => 'Ruang',
            'fk_golongan' => 'Fk Golongan',
            'tmt' => 'Tmt',
            'dokumen' => 'Dokumen',
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
     * Gets query for [[Penggolongangaji]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenggolongangaji()
    {
        return $this->hasOne(MPenggolongangaji::className(), ['id' => 'penggolongangaji_id']);
    }
}

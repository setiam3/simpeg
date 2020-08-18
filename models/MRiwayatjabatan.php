<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "riwayatjabatan".
 *
 * @property int $id
 * @property string $nip
 * @property string $namaJabatan
 * @property string $eselon
 * @property string $noSk
 * @property string $tglSk
 * @property string $tmtJabatan
 */
class MRiwayatjabatan extends \yii\db\ActiveRecord
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
            [['nip', 'namaJabatan', 'noSk', 'tglSk', 'tmtJabatan'], 'required'],
            [['tglSk', 'tmtJabatan'], 'safe'],
            [['nip'], 'string', 'max' => 20],
            [['namaJabatan', 'eselon', 'noSk'], 'string', 'max' => 255],
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
            'namaJabatan' => 'Nama Jabatan',
            'eselon' => 'Eselon',
            'noSk' => 'No Sk',
            'tglSk' => 'Tgl Sk',
            'tmtJabatan' => 'Tmt Jabatan',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_gaji".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $jmlTertanggung
 * @property double $gapok
 * @property string $fk_tunjangan
 */
class MGaji extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_gaji';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal', 'gapok'], 'required'],
            [['tanggal'], 'safe'],
            [['gapok'], 'number'],
            [['jmlTertanggung', 'fk_tunjangan'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal',
            'jmlTertanggung' => 'Jml Tertanggung',
            'gapok' => 'Gapok',
            'fk_tunjangan' => 'Fk Tunjangan',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_pangkatgolongan".
 *
 * @property int $id
 * @property string $jenis
 * @property string $golongan
 * @property string $ruang
 */
class MPangkatgolongan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_pangkatgolongan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenis', 'golongan', 'ruang'], 'required'],
            [['jenis'], 'string', 'max' => 255],
            [['golongan'], 'string', 'max' => 3],
            [['ruang'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis' => 'Jenis',
            'golongan' => 'Golongan',
            'ruang' => 'Ruang',
        ];
    }
}

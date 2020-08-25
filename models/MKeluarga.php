<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_keluarga".
 *
 * @property int $id
 * @property string $fk_biodata
 * @property string $hubunganKeluarga
 * @property string $nip
 */
class MKeluarga extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_keluarga';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_biodata', 'hubunganKeluarga', 'nip'], 'required'],
            [['fk_biodata', 'hubunganKeluarga', 'nip'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_biodata' => 'Fk Biodata',
            'hubunganKeluarga' => 'Hubungan Keluarga',
            'nip' => 'Nip',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jatahcuti".
 *
 * @property int $id
 * @property int $id_data
 * @property int $jumlah
 * @property int $sisa
 *
 * @property MBiodata $data
 */
class Jatahcuti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jatahcuti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_data', 'jumlah', 'sisa'], 'required'],
            [['id_data', 'jumlah', 'sisa'], 'default', 'value' => null],
            [['id_data', 'jumlah', 'sisa'], 'integer'],
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
            'id_data' => 'Id Data',
            'jumlah' => 'Jumlah',
            'sisa' => 'Sisa',
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

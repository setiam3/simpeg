<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_reff_tipe".
 *
 * @property int $tipereff_id
 * @property string|null $nama_reff_tipe
 * @property string|null $status
 *
 * @property MReferensi[] $mReferensis
 */
class MReffTipe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_reff_tipe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_reff_tipe', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tipereff_id' => 'Tipereff ID',
            'nama_reff_tipe' => 'Nama Reff Tipe',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[MReferensis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMReferensis()
    {
        return $this->hasMany(MReferensi::className(), ['tipe_referensi' => 'tipereff_id']);
    }
}

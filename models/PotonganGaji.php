<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "potongan_gaji".
 *
 * @property int $potongan_id
 * @property int|null $transgaji_id
 * @property int|null $potongan_desc
 * @property float|null $potongan_nominal
 * @property string|null $keterangan
 *
 * @property MReferensi $potonganDesc
 * @property TransaksiPenggajian $transgaji
 */
class PotonganGaji extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'potongan_gaji';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transgaji_id', 'potongan_desc'], 'default', 'value' => null],
            [['transgaji_id'], 'integer'],
            [['potongan_nominal'], 'number'],
            [['keterangan','potongan_desc'], 'string', 'max' => 255],
            [['transgaji_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransaksiPenggajian::className(), 'targetAttribute' => ['transgaji_id' => 'transgaji_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'potongan_id' => 'Potongan ID',
            'transgaji_id' => 'Transgaji ID',
            'potongan_desc' => 'Potongan Desc',
            'potongan_nominal' => 'Potongan Nominal',
            'keterangan' => 'Keterangan',
        ];
    }

    public function getTransgaji()
    {
        return $this->hasOne(TransaksiPenggajian::className(), ['transgaji_id' => 'transgaji_id']);
    }
}

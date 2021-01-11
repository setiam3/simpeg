<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hariliburnasional".
 *
 * @property int $id
 * @property string $tahun
 * @property string $tanggal
 * @property string $keterangan
 */
class Hariliburnasional extends \yii\redis\ActiveRecord

{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hariliburnasional';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun', 'tanggal', 'keterangan'], 'required'],
            [['tahun', 'keterangan'], 'string'],
            [['tanggal'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun' => 'Tahun',
            'tanggal' => 'Tanggal',
            'keterangan' => 'Keterangan',
        ];
    }
}

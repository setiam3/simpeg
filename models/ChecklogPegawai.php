<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checklog_pegawai".
 *
 * @property int $cheklog_id
 * @property int $checklogpegawai_id
 * @property string|null $kedatangan
 * @property string|null $pulang
 *
 * @property MChecklogPegawai $checklogpegawai
 */
class ChecklogPegawai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'checklog_pegawai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['checklogpegawai_id'], 'required'],
            [['checklogpegawai_id'], 'default', 'value' => null],
            [['checklogpegawai_id'], 'integer'],
            [['kedatangan', 'pulang'], 'safe'],
            [['checklogpegawai_id'], 'exist', 'skipOnError' => true, 'targetClass' => MChecklogPegawai::className(), 'targetAttribute' => ['checklogpegawai_id' => 'checklogpegawai_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cheklog_id' => 'Cheklog ID',
            'checklogpegawai_id' => 'Checklogpegawai ID',
            'kedatangan' => 'Kedatangan',
            'pulang' => 'Pulang',
        ];
    }

    /**
     * Gets query for [[Checklogpegawai]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChecklogpegawai()
    {
        return $this->hasOne(MChecklogPegawai::className(), ['checklogpegawai_id' => 'checklogpegawai_id']);
    }
}

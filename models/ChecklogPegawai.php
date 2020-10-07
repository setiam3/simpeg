<?php
namespace app\models;
use Yii;
class ChecklogPegawai extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'checklog_pegawai';
    }
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
    public function attributeLabels()
    {
        return [
            'cheklog_id' => 'Cheklog ID',
            'checklogpegawai_id' => 'Checklogpegawai ID',
            'kedatangan' => 'Kedatangan',
            'pulang' => 'Pulang',
        ];
    }
    public function getChecklogpegawai()
    {
        return $this->hasOne(MChecklogPegawai::className(), ['checklogpegawai_id' => 'checklogpegawai_id']);
    }
}

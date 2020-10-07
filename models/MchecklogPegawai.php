<?php
namespace app\models;
use Yii;
class MchecklogPegawai extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'checklog_pegawai';
    }
    public function rules()
    {
        return [
            [['checklogpegawai_id'], 'required'],
            [['kedatangan', 'pulang'], 'safe'],
            [['checklogpegawai_id'], 'string', 'max' => 50],
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

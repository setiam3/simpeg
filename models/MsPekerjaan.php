<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ms_pekerjaan".
 *
 * @property int $id
 * @property string $nama_pekerjaan Atau jabatan
 * @property int $status
 *
 * @property MsFormula[] $msFormulas
 */
class MsPekerjaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ms_pekerjaan';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_remun');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_pekerjaan', 'status'], 'required'],
            [['status'], 'integer'],
            [['nama_pekerjaan'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_pekerjaan' => 'Nama Pekerjaan',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[MsFormulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMsFormulas()
    {
        return $this->hasMany(MsFormula::className(), ['idpekerjaan' => 'id']);
    }
}

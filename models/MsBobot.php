<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ms_bobot".
 *
 * @property int $id
 * @property int $level
 * @property string $uraian
 * @property int $bobot
 * @property int|null $nilai_rasio
 * @property string|null $kategory
 *
 * @property MsFormula[] $msFormulas
 */
class MsBobot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ms_bobot';
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
            [['level', 'uraian', 'bobot'], 'required'],
            [['level', 'bobot', 'nilai_rasio'], 'integer'],
            [['uraian'], 'string'],
            [['kategory'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => 'Level',
            'uraian' => 'Uraian',
            'bobot' => 'Bobot',
            'nilai_rasio' => 'Nilai Rasio',
            'kategory' => 'Kategory',
        ];
    }

    /**
     * Gets query for [[MsFormulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMsFormulas()
    {
        return $this->hasMany(MsFormula::className(), ['id_bobot' => 'id']);
    }
}

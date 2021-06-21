<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ms_template".
 *
 * @property int $id
 * @property string $indikator
 * @property int $bobot
 * @property int $target
 * @property string|null $keterangan
 * @property int $parent
 * @property int $idunit
 *
 * @property MsFormula $parent0
 * @property MsUnit $idunit0
 */
class MsTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ms_template';
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
            [['indikator', 'bobot', 'target', 'parent', 'idunit'], 'required'],
            [['bobot', 'target', 'parent', 'idunit'], 'integer'],
            [['indikator'], 'string', 'max' => 45],
            [['keterangan'], 'string', 'max' => 255],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => MsFormula::className(), 'targetAttribute' => ['parent' => 'id']],
//            [['idunit'], 'exist', 'skipOnError' => true, 'targetClass' => MsUnit::className(), 'targetAttribute' => ['idunit' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'indikator' => 'Indikator',
            'bobot' => 'Bobot',
            'target' => 'Target',
            'keterangan' => 'Keterangan',
            'parent' => 'Parent',
            'idunit' => 'Idunit',
        ];
    }

    /**
     * Gets query for [[Parent0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(MsFormula::className(), ['id' => 'parent']);
    }

    /**
     * Gets query for [[Idunit0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdunit0()
    {
        return $this->hasOne(MsUnit::className(), ['id' => 'idunit']);
    }
}

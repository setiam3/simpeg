<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ms_formula".
 *
 * @property int $id
 * @property int $idpekerjaan
 * @property float|null $estimasi
 * @property int|null $total_score
 * @property int|null $id_bobot
 *
 * @property MsPekerjaan $idpekerjaan0
 * @property MsBobot $bobot
 * @property MsTemplate[] $msTemplates
 */
class Formula extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ms_formula';
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
            [['idpekerjaan'], 'required'],
            [['idpekerjaan', 'total_score', 'id_bobot'], 'integer'],
            [['estimasi'], 'number'],
            [['idpekerjaan'], 'exist', 'skipOnError' => true, 'targetClass' => MsPekerjaan::className(), 'targetAttribute' => ['idpekerjaan' => 'id']],
            [['id_bobot'], 'exist', 'skipOnError' => true, 'targetClass' => MsBobot::className(), 'targetAttribute' => ['id_bobot' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idpekerjaan' => 'Idpekerjaan',
            'estimasi' => 'Estimasi',
            'total_score' => 'Total Score',
            'id_bobot' => 'Id Bobot',
        ];
    }

    /**
     * Gets query for [[Idpekerjaan0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdpekerjaan0()
    {
        return $this->hasOne(MsPekerjaan::className(), ['id' => 'idpekerjaan']);
    }

    /**
     * Gets query for [[Bobot]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBobot()
    {
        return $this->hasOne(MsBobot::className(), ['id' => 'id_bobot']);
    }

    /**
     * Gets query for [[MsTemplates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMsTemplates()
    {
        return $this->hasMany(MsTemplate::className(), ['parent' => 'id']);
    }
}

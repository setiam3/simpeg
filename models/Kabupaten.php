<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "regencies".
 *
 * @property string $id
 * @property string $province_id
 * @property string $name
 * @property string $alias
 *
 * @property Districts[] $districts
 * @property Provinces $province
 */
class Kabupaten extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regencies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'name'], 'required'],
            [['id'], 'string', 'max' => 4],
            [['province_id'], 'string', 'max' => 2],
            [['name', 'alias'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'province_id' => 'Province ID',
            'name' => 'Name',
            'alias' => 'Alias',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(Kecamatan::className(), ['regency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getProvince()
    // {
    //     return $this->hasOne(Provinces::className(), ['id' => 'province_id']);
    // }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_unit".
 *
 * @property int $id
 * @property string|null $kode
 * @property string|null $unit
 * @property string|null $fk_instalasi
 * @property int|null $is_vip
 * @property int|null $aktif
 *
 * @property Riwayatjabatan[] $riwayatjabatans
 */
class MUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_vip', 'aktif'], 'default', 'value' => null],
            [['is_vip', 'aktif'], 'integer'],
            [['kode', 'fk_instalasi'], 'string', 'max' => 200],
            [['unit'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'unit' => 'Unit',
            'fk_instalasi' => 'Fk Instalasi',
            'is_vip' => 'Is Vip',
            'aktif' => 'Aktif',
        ];
    }

    /**
     * Gets query for [[Riwayatjabatans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRiwayatjabatans()
    {
        return $this->hasMany(Riwayatjabatan::className(), ['unit_kerja' => 'id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pinjaman".
 *
 * @property int $id
 * @property int $id_data
 * @property string $tanggal
 * @property string $jenis
 * @property string $namaBarang
 * @property float $jumlah
 *
 * @property MBiodata $data
 */
class Pinjaman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pinjaman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_data', 'tanggal', 'jenis', 'namaBarang', 'jumlah'], 'required'],
            [['id', 'id_data'], 'default', 'value' => null],
            [['id', 'id_data'], 'integer'],
            [['tanggal'], 'safe'],
            [['jumlah'], 'number'],
            [['jenis', 'namaBarang'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => MBiodata::className(), 'targetAttribute' => ['id_data' => 'id_data']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data' => 'Id Data',
            'tanggal' => 'Tanggal',
            'jenis' => 'Jenis',
            'namaBarang' => 'Nama Barang',
            'jumlah' => 'Jumlah',
        ];
    }

    /**
     * Gets query for [[Data]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getData()
    {
        return $this->hasOne(MBiodata::className(), ['id_data' => 'id_data']);
    }
    
}

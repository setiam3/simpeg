<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MBiodata;

/**
 * MBiodataSearch represents the model behind the search form of `app\models\MBiodata`.
 */
class MBiodataSearch extends MBiodata
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_data', 'parent_id', 'status_hubungan_keluarga', 'checklog_id'], 'integer'],
            [['nip', 'nama', 'tempatLahir', 'tanggalLahir', 'alamat', 'kabupatenKota', 'kecamatan', 'kelurahan', 'jenisKelamin', 'agama', 'telp', 'email', 'statusPerkawinan', 'gelarDepan', 'gelarBelakang', 'nik', 'foto', 'fotoNik', 'golonganDarah', 'is_pegawai'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MBiodata::find()->where(['is_pegawai'=>'1']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_data' => $this->id_data,
            'parent_id' => $this->parent_id,
            'tanggalLahir' => $this->tanggalLahir,
            'status_hubungan_keluarga' => $this->status_hubungan_keluarga,
            'checklog_id' => $this->checklog_id,
        ]);

        $query->andFilterWhere(['ilike', 'nip', $this->nip])
            ->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'tempatLahir', $this->tempatLahir])
            ->andFilterWhere(['ilike', 'alamat', $this->alamat])
            ->andFilterWhere(['ilike', 'kabupatenKota', $this->kabupatenKota])
            ->andFilterWhere(['ilike', 'kecamatan', $this->kecamatan])
            ->andFilterWhere(['ilike', 'kelurahan', $this->kelurahan])
            ->andFilterWhere(['ilike', 'jenisKelamin', $this->jenisKelamin])
            ->andFilterWhere(['ilike', 'agama', $this->agama])
            ->andFilterWhere(['ilike', 'telp', $this->telp])
            ->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'statusPerkawinan', $this->statusPerkawinan])
            ->andFilterWhere(['ilike', 'gelarDepan', $this->gelarDepan])
            ->andFilterWhere(['ilike', 'gelarBelakang', $this->gelarBelakang])
            ->andFilterWhere(['ilike', 'nik', $this->nik])
            ->andFilterWhere(['ilike', 'foto', $this->foto])
            ->andFilterWhere(['ilike', 'fotoNik', $this->fotoNik])
            ->andFilterWhere(['ilike', 'golonganDarah', $this->golonganDarah])
            ->andFilterWhere(['ilike', 'is_pegawai', $this->is_pegawai]);

        return $dataProvider;
    }
}

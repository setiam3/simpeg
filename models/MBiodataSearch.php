<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MBiodata;

/**
 * MBiodataSearch represents the model behind the search form about `app\models\MBiodata`.
 */
class MBiodataSearch extends MBiodata
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_data', 'parent_id', 'status_hubungan_keluarga'], 'integer'],
            [['nip', 'nama', 'tempatLahir', 'tanggalLahir', 'alamat', 'kabupatenKota', 'kecamatan', 'kelurahan', 'jenisKelamin', 'agama', 'telp', 'email', 'statusPerkawinan', 'gelarDepan', 'gelarBelakang', 'nik', 'foto', 'fotoNik', 'golonganDarah', 'is_pegawai'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = MBiodata::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_data' => $this->id_data,
            'parent_id' => $this->parent_id,
            'tanggalLahir' => $this->tanggalLahir,
            'status_hubungan_keluarga' => $this->status_hubungan_keluarga,
        ]);

        $query->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tempatLahir', $this->tempatLahir])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'kabupatenKota', $this->kabupatenKota])
            ->andFilterWhere(['like', 'kecamatan', $this->kecamatan])
            ->andFilterWhere(['like', 'kelurahan', $this->kelurahan])
            ->andFilterWhere(['like', 'jenisKelamin', $this->jenisKelamin])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'telp', $this->telp])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'statusPerkawinan', $this->statusPerkawinan])
            ->andFilterWhere(['like', 'gelarDepan', $this->gelarDepan])
            ->andFilterWhere(['like', 'gelarBelakang', $this->gelarBelakang])
            ->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'fotoNik', $this->fotoNik])
            ->andFilterWhere(['like', 'golonganDarah', $this->golonganDarah])
            ->andFilterWhere(['like', 'is_pegawai', $this->is_pegawai]);

        return $dataProvider;
    }
}

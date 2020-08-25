<?php
namespace app\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VPegawai;
use app\models\MPegawai;
class PegawaiSearch extends VPegawai
{
    public function rules()
    {
        return [
            [['id'],'integer'],
            [['id','nip', 'statusPegawai', 'status', 'nama', 'tempatLahir', 'tanggalLahir', 'alamat','kabupatenKota', 'kecamatan', 'kelurahan', 'jenisKelamin', 'agama', 'nik','npwp','email'],'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = VPegawai::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key'=>'id',
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'tanggalLahir', $this->tanggalLahir])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}

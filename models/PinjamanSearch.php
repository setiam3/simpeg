<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pinjaman;
class PinjamanSearch extends Pinjaman
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tanggal', 'jenis', 'namaBarang', 'id_data'], 'safe'],
            [['jumlah'], 'number'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = Pinjaman::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->joinWith('data');
        $query->andFilterWhere([
            'id' => $this->id,
            'tanggal' => $this->tanggal,
            'jumlah' => $this->jumlah,
        ]);
        $query->andFilterWhere(['like', 'm_referensi.nama_referensi', $this->jenis])
            ->andFilterWhere(['like', 'namaBarang', $this->namaBarang])
            ->andFilterWhere(['like', 'm_biodata.nama', $this->id_data]);
        return $dataProvider;
    }
}

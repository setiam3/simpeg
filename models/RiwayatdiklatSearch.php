<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Riwayatdiklat;
class RiwayatdiklatSearch extends Riwayatdiklat
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['namaDiklat', 'id_data', 'tempat', 'penyelenggara', 'mulai', 'selesai', 'dokumen'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params, $where = null)
    {
        $query = Riwayatdiklat::find()->where($where);
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
            'mulai' => $this->mulai,
            'selesai' => $this->selesai,
        ]);
        $query->andFilterWhere(['like', 'namaDiklat', $this->namaDiklat])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'penyelenggara', $this->penyelenggara])
            ->andFilterWhere(['like', 'dokumen', $this->dokumen])
            ->andFilterWhere(['like', 'm_biodata.nama', $this->id_data]);
        return $dataProvider;
    }
}

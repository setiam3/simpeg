<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TransaksiPenggajian;
class TransaksiPenggajianSearch extends TransaksiPenggajian
{
    public function rules()
    {
        return [
            [['transgaji_id', 'pelaksana_id'], 'integer'],
            [['nomor_transgaji', 'data_id', 'tgl_gaji', 'tgl_input'], 'safe'],
            [['total_brutto_gaji', 'total_bersih_gaji'], 'number'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params, $where = NULL)
    {
        $query = TransaksiPenggajian::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->joinWith('data');
        $query->andFilterWhere([
            'transgaji_id' => $this->transgaji_id,
            'tgl_gaji' => $this->tgl_gaji,
            'pelaksana_id' => $this->pelaksana_id,
            'tgl_input' => $this->tgl_input,
            'total_brutto_gaji' => $this->total_brutto_gaji,
            'total_bersih_gaji' => $this->total_bersih_gaji,
        ]);
        $query->andFilterWhere(['like', 'nomor_transgaji', $this->nomor_transgaji])
            ->andFilterWhere(['like', 'm_biodata.nama', $this->data_id]);
        return $dataProvider;
    }
}

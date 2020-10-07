<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jatahcuti;
class JatahcutiSearch extends Jatahcuti
{
    public function rules()
    {
        return [
            [['id', 'id_data', 'jumlah', 'sisa'], 'integer'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = Jatahcuti::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'id_data' => $this->id_data,
            'jumlah' => $this->jumlah,
            'sisa' => $this->sisa,
        ]);
        return $dataProvider;
    }
}

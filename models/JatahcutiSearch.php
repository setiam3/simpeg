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
            [['id', 'sisa'], 'integer'],
            [['id_data'],'safe']
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
        $query->joinWith('data as d');
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'sisa' => $this->sisa,
        ]);
        $query->andFilterWhere(['like', 'd.nama', $this->id_data]);
        return $dataProvider;
    }
}

<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MUnit;
class MUnitSearch extends MUnit
{
    public function rules()
    {
        return [
            [['id', 'is_vip', 'aktif'], 'integer'],
            [['kode', 'unit', 'fk_instalasi'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = MUnit::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'is_vip' => $this->is_vip,
            'aktif' => $this->aktif,
        ]);
        $query->andFilterWhere(['like', 'kode', $this->kode])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'fk_instalasi', $this->fk_instalasi]);
        return $dataProvider;
    }
}

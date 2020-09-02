<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MUnit;

/**
 * MUnitSearch represents the model behind the search form about `app\models\MUnit`.
 */
class MUnitSearch extends MUnit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_vip', 'aktif'], 'integer'],
            [['kode', 'unit', 'fk_instalasi'], 'safe'],
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
        $query = MUnit::find();

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

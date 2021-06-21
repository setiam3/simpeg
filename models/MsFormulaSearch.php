<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MsFormula;

/**
 * MsFormulaSearch represents the model behind the search form about `app\models\MsFormula`.
 */
class MsFormulaSearch extends MsFormula
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'total_score', 'id_bobot'], 'integer'],
            [['idpekerjaan','nama_pekerjaan'], 'safe'],
            [['estimasi'], 'number'],
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
        $query = MsFormula::find();

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
//            'idpekerjaan' => $this->idpekerjaan,
            'estimasi' => $this->estimasi,
            'total_score' => $this->total_score,
            'id_bobot' => $this->id_bobot,
        ]);
        $query->andFilterWhere(['like', 'nama_pekerjaan', $this->idpekerjaan]);

        return $dataProvider;
    }
}

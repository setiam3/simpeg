<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bobot;

/**
 * BobotSearch represents the model behind the search form about `app\models\Bobot`.
 */
class BobotSearch extends Bobot
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'level', 'bobot', 'nilai_rasio'], 'integer'],
            [['uraian', 'kategory'], 'safe'],
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
        $query = Bobot::find();

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
            'level' => $this->level,
            'bobot' => $this->bobot,
            'nilai_rasio' => $this->nilai_rasio,
        ]);

        $query->andFilterWhere(['like', 'uraian', $this->uraian])
            ->andFilterWhere(['like', 'kategory', $this->kategory]);

        return $dataProvider;
    }
}

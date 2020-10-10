<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hariliburnasional;

class HariliburnasionalSearch extends Hariliburnasional
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tahun', 'tanggal', 'keterangan'], 'safe'],
        ];
    }

    public function scenarios()
    {

        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Hariliburnasional::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {


            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['like', 'tahun', $this->tahun])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}

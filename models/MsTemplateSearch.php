<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MsTemplate;

/**
 * MsTemplateSearch represents the model behind the search form about `app\models\MsTemplate`.
 */
class MsTemplateSearch extends MsTemplate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'target', 'parent', 'idunit'], 'integer'],
            [['indikator', 'keterangan'], 'safe'],
            [['bobot'], 'number'],
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
        $query = MsTemplate::find();

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
            'bobot' => $this->bobot,
            'target' => $this->target,
            'parent' => $this->parent,
            'idunit' => $this->idunit,
        ]);

        $query->andFilterWhere(['like', 'indikator', $this->indikator])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}

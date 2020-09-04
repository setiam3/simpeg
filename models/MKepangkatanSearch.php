<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MKepangkatan;

/**
 * MKepangkatanSearch represents the model behind the search form about `app\models\MKepangkatan`.
 */
class MKepangkatanSearch extends MKepangkatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_data', 'penggolongangaji_id', 'fk_golongan'], 'integer'],
            [['ditetapkanOleh', 'noSk', 'tglSk', 'tmtPangkat', 'ruang', 'tmt', 'dokumen'], 'safe'],
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
        $query = MKepangkatan::find();

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
            'id_data' => $this->id_data,
            'tglSk' => $this->tglSk,
            'penggolongangaji_id' => $this->penggolongangaji_id,
            'tmtPangkat' => $this->tmtPangkat,
            'fk_golongan' => $this->fk_golongan,
        ]);

        $query->andFilterWhere(['like', 'ditetapkanOleh', $this->ditetapkanOleh])
            ->andFilterWhere(['like', 'noSk', $this->noSk])
            ->andFilterWhere(['like', 'ruang', $this->ruang])
            ->andFilterWhere(['like', 'tmt', $this->tmt])
            ->andFilterWhere(['like', 'dokumen', $this->dokumen]);

        return $dataProvider;
    }
}

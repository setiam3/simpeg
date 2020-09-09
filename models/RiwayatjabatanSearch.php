<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Riwayatjabatan;

/**
 * RiwayatjabatanSearch represents the model behind the search form about `app\models\Riwayatjabatan`.
 */
class RiwayatjabatanSearch extends Riwayatjabatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'unit_kerja'], 'integer'],
            [['eselon', 'id_data', 'id_jabatan', 'noSk', 'tglSk', 'tmtJabatan', 'dokumen'], 'safe'],
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
        $query = Riwayatjabatan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('data');
        $query->joinWith('jabatan');

        $query->andFilterWhere([
            'id' => $this->id,
            //'id_data' => $this->id_data,
            //'id_jabatan' => $this->id_jabatan,
            'tglSk' => $this->tglSk,
            'tmtJabatan' => $this->tmtJabatan,
            'unit_kerja' => $this->unit_kerja,
        ]);

        $query->andFilterWhere(['like', 'eselon', $this->eselon])
            ->andFilterWhere(['like', 'noSk', $this->noSk])
            ->andFilterWhere(['like', 'dokumen', $this->dokumen])
            ->andFilterWhere(['like', 'm_biodata.nama', $this->id_data])
            ->andFilterWhere(['like', 'm_referensi.nama_referensi', $this->id_jabatan]);

        return $dataProvider;
    }
}

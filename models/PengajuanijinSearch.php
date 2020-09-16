<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pengajuanijin;

/**
 * PengajuanijinSearch represents the model behind the search form about `app\models\Pengajuanijin`.
 */
class PengajuanijinSearch extends Pengajuanijin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['id', 'approval1', 'approval2', 'disetujui', 'id_data'], 'integer'],
            [['tanggalPengajuan', 'tanggalMulai', 'tanggalAkhir', 'alasan', 'jenisIjin'], 'safe'],
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
    public function search($params, $where = null)
    {
        $query = Pengajuanijin::find()->where($where);

        //        $query->joinWith('data');

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
            'tanggalPengajuan' => $this->tanggalPengajuan,
            'tanggalMulai' => $this->tanggalMulai,
            'tanggalAkhir' => $this->tanggalAkhir,
            'id_data', $this->id_data,
            'approval1' => $this->approval1,
            'approval2' => $this->approval2,
            'disetujui' => $this->disetujui,
        ]);

        $query->andFilterWhere(['like', 'alasan', $this->alasan])

            //            ->andFilterWhere(['like', 'm_biodata.nama', $this->id_data])

            ->andFilterWhere(['like', 'jenisIjin', $this->jenisIjin]);

        return $dataProvider;
    }
}

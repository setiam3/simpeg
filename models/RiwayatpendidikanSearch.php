<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Riwayatpendidikan;

/**
 * RiwayatpendidikanSearch represents the model behind the search form about `app\models\Riwayatpendidikan`.
 */
class RiwayatpendidikanSearch extends Riwayatpendidikan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_data', 'tingkatPendidikan', 'medis'], 'integer'],
            [['jurusan', 'namaSekolah', 'thLulus', 'dokumen', 'no_ijazah', 'tgl_ijazah', 'thMasuk', 'suratijin', 'tgl_berlaku_ijin'], 'safe'],
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
    public function search($params,$where=NULL)
    {
        $query = Riwayatpendidikan::find()->where($where);

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
            'tingkatPendidikan' => $this->tingkatPendidikan,
            'tgl_ijazah' => $this->tgl_ijazah,
            'medis' => $this->medis,
            'tgl_berlaku_ijin' => $this->tgl_berlaku_ijin,
        ]);

        $query->andFilterWhere(['like', 'jurusan', $this->jurusan])
            ->andFilterWhere(['like', 'namaSekolah', $this->namaSekolah])
            ->andFilterWhere(['like', 'thLulus', $this->thLulus])
            ->andFilterWhere(['like', 'dokumen', $this->dokumen])
            ->andFilterWhere(['like', 'no_ijazah', $this->no_ijazah])
            ->andFilterWhere(['like', 'thMasuk', $this->thMasuk])
            ->andFilterWhere(['like', 'suratijin', $this->suratijin]);

        return $dataProvider;
    }
}

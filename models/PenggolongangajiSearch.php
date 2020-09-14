<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Penggolongangaji;

/**
 * PenggolongangajiSearch represents the model behind the search form about `app\models\Penggolongangaji`.
 */
class PenggolongangajiSearch extends Penggolongangaji
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'masa_kerja',], 'integer'],
            [['gaji', 'status_penggolongan', 'ruang','pangkat_id','jenis_pegawai'], 'safe'],
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
        $query = Penggolongangaji::find();
        $query->joinWith('pangkat as r');
        $query->joinWith('jenisPegawai as r');

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
            'masa_kerja' => $this->masa_kerja,
        ]);

        $query->andFilterWhere(['like', 'gaji', $this->gaji])
            ->andFilterWhere(['like', 'status_penggolongan', $this->status_penggolongan])
            ->andFilterWhere(['like', 'r.nama_referensi', $this->pangkat_id])
            ->andFilterWhere(['like', 'r.nama_referensi', $this->jenis_pegawai])
            ->andFilterWhere(['like', 'ruang', $this->ruang]);

        return $dataProvider;
    }
}

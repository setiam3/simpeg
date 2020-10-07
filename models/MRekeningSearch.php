<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MRekening;
class MRekeningSearch extends MRekening
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nomor_rekening', 'id_data', 'bank_id', 'npwp', 'fotoNpwp', 'fotoRekening'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = MRekening::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->joinWith('data');
        $query->joinWith('bank');
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
        $query->andFilterWhere(['like', 'nomor_rekening', $this->nomor_rekening])
            ->andFilterWhere(['like', 'npwp', $this->npwp])
            ->andFilterWhere(['like', 'fotoNpwp', $this->fotoNpwp])
            ->andFilterWhere(['like', 'fotoRekening', $this->fotoRekening])
            ->andFilterWhere(['like', 'm_biodata.nama', $this->id_data])
            ->andFilterWhere(['like', 'm_referensi.nama_referensi', $this->bank_id]);
        return $dataProvider;
    }
}

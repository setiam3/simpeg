<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pengajuanijin;
class Approvel2Search extends Pengajuanijin
{
    public function rules()
    {
        return [
            [['id',  'approval1',  'disetujui'], 'integer'],
            [['tanggalPengajuan', 'id_data', 'approval2', 'tanggalMulai', 'tanggalAkhir', 'alasan', 'jenisIjin'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params, $where)
    {
        $query = Pengajuanijin::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->joinWith('data');
        $query->joinWith('approval10');
        $query->andFilterWhere([
            'id' => $this->id,
            'tanggalPengajuan' => $this->tanggalPengajuan,
            'tanggalMulai' => $this->tanggalMulai,
            'tanggalAkhir' => $this->tanggalAkhir,
            'approval2' => $this->approval2,
            'disetujui' => $this->disetujui,
        ]);
        $query->andFilterWhere(['like', 'alasan', $this->alasan])
            ->andFilterWhere(['like', 'jenisIjin', $this->jenisIjin])
            ->andFilterWhere(['like', 'm_biodata.nama', $this->id_data])
            ->andFilterWhere(['like', 'm_biodata.nama', $this->approval10]);
        return $dataProvider;
    }
}

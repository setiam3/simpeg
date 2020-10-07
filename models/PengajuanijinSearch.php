<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pengajuanijin;
class PengajuanijinSearch extends Pengajuanijin
{
    public function rules()
    {
        return [
            [['id', 'approval1', 'approval2', 'disetujui'], 'integer'],
            [['tanggalPengajuan', 'tanggalMulai', 'tanggalAkhir','id_data', 'alasan', 'jenisIjin'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params, $where = null)
    {
        $query = Pengajuanijin::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->joinWith('data as d');
        $query->andFilterWhere([
            'id' => $this->id,
            'tanggalPengajuan' => $this->tanggalPengajuan,
            'tanggalMulai' => $this->tanggalMulai,
            'tanggalAkhir' => $this->tanggalAkhir,
            'approval1' => $this->approval1,
            'approval2' => $this->approval2,
            'disetujui' => $this->disetujui,
        ]);
        $query->andFilterWhere(['like', 'alasan', $this->alasan])
            ->andFilterWhere(['like', 'd.nama', $this->id_data])
            ->andFilterWhere(['like', 'jenisIjin', $this->jenisIjin]);
        return $dataProvider;
    }
}

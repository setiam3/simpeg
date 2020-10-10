<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pengajuanijin;
class Approvel2Search extends Pengajuanijin
{
    public $jabatan,$unit;
    public function rules()
    {
        return [
            [['id',  'disetujui'], 'integer'],
            [['tanggalPengajuan','jabatan','unit', 'id_data','approval1', 'approval2', 'tanggalMulai', 'tanggalAkhir', 'alasan', 'jenisIjin'], 'safe'],
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
        $query->joinWith(['data as d'=>function($q){
            $q->joinWith(['riwayatjabatan as r'=>function($q){
                $q->joinWith('jabatan as j');
                $q->joinWith('unitKerja as u');
            }]);
        }]);
        $query->joinWith('approval10 as p');
        $query->andFilterWhere([
            'id' => $this->id,
            'tanggalPengajuan' => $this->tanggalPengajuan,
            'tanggalMulai' => $this->tanggalMulai,
            'tanggalAkhir' => $this->tanggalAkhir,
            'disetujui' => $this->disetujui,
        ]);
        $query->andFilterWhere(['like', 'alasan', $this->alasan])
            ->andFilterWhere(['like', 'jenisIjin', $this->jenisIjin])
            ->andFilterWhere(['like', 'u.unit', $this->unit])
            ->andFilterWhere(['like', 'j.nama_referensi', $this->jabatan])
            ->andFilterWhere(['like', 'd.nama', $this->id_data])
            ->andFilterWhere(['like', 'p.nama', $this->approval1]);
        return $dataProvider;
    }
}

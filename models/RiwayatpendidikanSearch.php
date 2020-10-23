<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Riwayatpendidikan;
class RiwayatpendidikanSearch extends Riwayatpendidikan
{
    public $nip;
    public function rules()
    {
        return [
            [['id', 'medis'], 'integer'],
            [['jurusan','tingkatPendidikan','nip','id_data', 'namaSekolah', 'thLulus', 'dokumen', 'no_ijazah', 'tgl_ijazah', 'thMasuk', 'suratijin', 'tgl_berlaku_ijin','tgl_akhir_ijin'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params, $where = NULL)
    {
        $query = Riwayatpendidikan::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->joinWith('data as d');
        $query->joinWith('tingpen as t');
        $query->andFilterWhere([
            'id' => $this->id,
            'tgl_ijazah' => $this->tgl_ijazah,
            'medis' => $this->medis,
            'tgl_berlaku_ijin' => $this->tgl_berlaku_ijin,
            'tgl_akhir_ijin' => $this->tgl_akhir_ijin,
        ]);
        $query->andFilterWhere(['like', 'jurusan', $this->jurusan])
            ->andFilterWhere(['like', 'namaSekolah', $this->namaSekolah])
            ->andFilterWhere(['like', 'thLulus', $this->thLulus])
            ->andFilterWhere(['like', 'dokumen', $this->dokumen])
            ->andFilterWhere(['like', 'no_ijazah', $this->no_ijazah])
            ->andFilterWhere(['like', 'thMasuk', $this->thMasuk])
            ->andFilterWhere(['like', 'd.nama', $this->id_data])
            ->andFilterWhere(['like', 'd.nip', $this->nip])
            ->andFilterWhere(['like', 't.nama_referensi', $this->tingkatPendidikan])
            ->andFilterWhere(['like', 'suratijin', $this->suratijin]);
        return $dataProvider;
    }
}

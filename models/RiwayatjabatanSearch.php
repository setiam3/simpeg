<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Riwayatjabatan;
class RiwayatjabatanSearch extends Riwayatjabatan
{
    public function rules()
    {
        return [
            [['id', 'unit_kerja'], 'integer'],
            [['eselon', 'id_data', 'id_jabatan', 'noSk', 'tglSk', 'tmtJabatan', 'dokumen'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params,$where=null)
    {
        $query = Riwayatjabatan::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->joinWith('data');
        $query->joinWith('jabatan');
        $query->andFilterWhere([
            'id' => $this->id,
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

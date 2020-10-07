<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MKepangkatan;
class MKepangkatanSearch extends MKepangkatan
{
    public function rules()
    {
        return [
            [['id','fk_golongan', ], 'integer'],
            [['ditetapkanOleh', 'noSk', 'tglSk', 'tmtPangkat', 'ruang', 'tmt', 'dokumen','id_data','penggolongangaji_id',], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params,$where=null)
    {
        $query = MKepangkatan::find()->where($where);
        $query->joinWith('data as d');
        $query->joinWith('penggolongangaji as g');
        $query->leftJoin('m_referensi as p','g.pangkat_id=p.reff_id');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'tglSk' => $this->tglSk,
            'tmtPangkat' => $this->tmtPangkat,
            'fk_golongan' => $this->fk_golongan,
        ]);
        $query->andFilterWhere(['like', 'ditetapkanOleh', $this->ditetapkanOleh])
            ->andFilterWhere(['like', 'noSk', $this->noSk])
            ->andFilterWhere(['like', 'ruang', $this->ruang])
            ->andFilterWhere(['like', 'tmt', $this->tmt])
            ->andFilterWhere(['like', 'd.nama', $this->id_data])
            ->andFilterWhere(['like', 'p.nama_referensi', $this->penggolongangaji_id])
            ->andFilterWhere(['like', 'dokumen', $this->dokumen]);
        return $dataProvider;
    }
}

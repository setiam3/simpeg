<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;
class UserSearch extends Users
{
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'id_data'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = Users::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id_data' => $this->id_data,
        ]);
        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);
        return $dataProvider;
    }
}

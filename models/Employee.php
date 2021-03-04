<?php
namespace app\models;
class Employee extends \yii\redis\ActiveRecord
{
    public function attributes()
    {
        return ['id', 'name', 'gender', 'address', 'status'];
    }
     
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['gender','status'], 'integer'],
            [['address'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }
}
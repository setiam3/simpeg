<?php 
namespace app\widgets;
use yii\db\Query;


class Advquery extends Query{
    public $whereMonth;

    public function whereMonth($column, $value,$params=[])
    {
        $this->where = [
            'month("'.$column.'")'=>$value
        ];
        $this->addParams($params);
        return $this;
        
    }

}
<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
$column =  [
    [
        'attribute'=>'nama',
    ],
];
Pjax::begin();
echo GridView::widget([
    'dataProvider' => \Yii::$app->tools->nextPensiun(),
    'columns' => $column,
]);
Pjax::end();
?>
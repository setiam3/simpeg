<?php
use yii\helpers\Url;
use yii\helpers\Html;
//use kartik\grid\GridView;
use yii\grid\GridView;
use yii\widgets\Pjax;
$column =  [
    [
        'attribute'=>'nama',
    ],
    [
        'attribute'=>'tgl_akhir_ijin',
    ],

];
Pjax::begin();
echo GridView::widget([
    'dataProvider' => \Yii::$app->tools->sip(),
    'columns' => $column,
    // 'striped' => true,
    // 'condensed' => true,
    // 'responsive' => true,
]);
Pjax::end();
?>
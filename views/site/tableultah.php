<?php
use yii\helpers\Url;
use yii\helpers\Html;
//use kartik\grid\GridView;
use yii\grid\GridView;
use yii\widgets\Pjax;
$column =  [
    // [
    //     // 'class' => 'kartik\grid\SerialColumn',
    //     'width' => '30px',
    // ],
    [
        // 'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama',
        // 'value' => 'nama',
    ],
    [
        // 'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tanggalLahir',
    ],

];
Pjax::begin();
echo GridView::widget([
    // 'moduleId' => 'gridview',
    'dataProvider' => \Yii::$app->tools->ultahPegawai(),
    'columns' => $column,
    // 'striped' => true,
    // 'condensed' => true,
    // 'responsive' => true,
]);
Pjax::end();
?>
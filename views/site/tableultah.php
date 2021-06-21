<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
$column =  ['nama','tanggalLahir'];
Pjax::begin();
echo GridView::widget([
    'dataProvider' => \Yii::$app->tools->ultahPegawai(),
    'columns' => $column,
]);
Pjax::end();
?>
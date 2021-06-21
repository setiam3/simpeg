<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
$column =  ['nama','tgl_akhir_ijin'];
Pjax::begin();
echo GridView::widget([
    'dataProvider' => \Yii::$app->tools->sip(),
    'columns' => $column,
]);
Pjax::end();
?>
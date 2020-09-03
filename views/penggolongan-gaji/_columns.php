<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Pangkat /Golongan',
        'value' => 'pangkat.nama_referensi',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'masa_kerja',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'gaji',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status_penggolongan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ruang',
    ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'jenis_pegawai',
         'value' => 'jenisPegawai.nama_referensi',
     ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) {
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'],
    ],

];

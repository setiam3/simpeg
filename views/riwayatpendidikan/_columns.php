<?php
use yii\helpers\Url;
use yii\helpers\Html;

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
        'attribute'=>'NIP',
        'value' => 'data.nip',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Nama',
        'value' => 'data.nama',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tingkatPendidikan',
        'value' => 'pendidikan.nama_referensi',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'jurusan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'namaSekolah',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'no_ijazah',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'thLulus',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'dokumen',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'no_ijazah',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tgl_ijazah',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'thMasuk',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'buttons'=>[
            'view'=>function ($url, $model) {
                $t = '@web/riwayatpendidikan/view?id='.$model->id;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',Url::to($t),['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip']);
            },
            'update'=>function ($url, $model) {
                $t = '@web/riwayatpendidikan/update?id='.$model->id;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>',Url::to($t),['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip']);
            },
            'delete'=>function ($url, $model) {
                $t = '@web/riwayatpendidikan/delete?id='.$model->id;
                return Html::a('<span class="glyphicon glyphicon-trash"></span>',Url::to($t),['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item']);
            },
        ],
    ],

];   
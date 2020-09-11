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
    [

        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'unit',
        'value'=>'data.riwayatjabatan.jabatan.nama_referensi'
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Nama Pegawai',
        'value' => 'data.nama',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tanggalPengajuan',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tanggalMulai',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tanggalAkhir',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'alasan',
    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'approval1',
        'value' => 'approval10.nama',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'approval2',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'disetujui',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'jenisIjin',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'buttons' => [
            'view' => function ($url, $model) {
                $idmodal = md5($model::className());
                $t = '@web/approvel2/view?id=' . $model->id;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $idmodal, 'title' => 'View', 'data-toggle' => 'tooltip']);
            },
            'update' => function ($url, $model) {
                $idmodal = md5($model::className());
                $t = '@web/approvel2/update?id=' . $model->id;

                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target'=>'#'.$idmodal, 'title' => 'Update', 'data-toggle' => 'tooltip']);

            },
            'delete' => function ($url, $model) {
                $idmodal = md5($model::className());
                $t = '@web/approvel2/delete?id=' . $model->id;

                return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to($t), [
                    'role' => 'modal-remote', 'data-target'=>'#'.$idmodal, 'title' => 'Delete',
                    'data-confirm' => false, 'data-method' => false,
                    'data-request-method' => 'post',
                    'data-toggle' => 'tooltip',
                    'data-confirm-title' => 'Are you sure?',
                    'data-confirm-message' => 'Are you sure want to delete this item'
                ]);

            },
        ],
    ],

];

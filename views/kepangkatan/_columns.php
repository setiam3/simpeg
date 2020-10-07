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
        'attribute'=>'id_data',
        'value' => 'data.namalengkap',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ditetapkanOleh',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'noSk',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tglSk',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'penggolongangaji_id',
        'value' => 'penggolongangaji.pangkat.nama_referensi',
    ],
    // [
//    penggolongangaji->pangkat->nama_referensi
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tmtPangkat',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ruang',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fk_golongan',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tmt',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'dokumen',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) {
                return Url::to([$action,'id'=>$key]);
        },
        'buttons' => [
            'view' => function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/kepangkatan/view?id=' . $model->id;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($t), ['role' => 'modal-remote','data-target'=>'#'.$idmodal, 'title' => 'View', 'data-toggle' => 'tooltip']);
            },
            'update' => function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/kepangkatan/update?id=' . $model->id;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target'=>'#'.$idmodal, 'title' => 'Update', 'data-toggle' => 'tooltip']);
            },
            'delete' => function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/kepangkatan/delete?id=' . $model->id;
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

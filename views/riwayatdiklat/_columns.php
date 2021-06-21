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
        'value' =>function($model){
            return !empty($model->data->gelarDepan)?$model->data->gelarDepan:''.$model->data->nama.!empty($model->data->gelarBelakang)?$model->data->gelarBelakang:'';
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'namaDiklat',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tempat',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'penyelenggara',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'mulai',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'selesai',
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
                $t = '@web/riwayatdiklat/view?id=' . $model->id;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($t), ['role' => 'modal-remote','data-target'=>'#'.$idmodal, 'title' => 'View', 'data-toggle' => 'tooltip']);
            },
            'update' => function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/riwayatdiklat/update?id=' . $model->id;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target'=>'#'.$idmodal, 'title' => 'Update', 'data-toggle' => 'tooltip']);
            },
            'delete' => function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/riwayatdiklat/delete?id=' . $model->id;
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
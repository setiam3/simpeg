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
        'attribute'=>'tanggalPengajuan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tanggalMulai',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tanggalAkhir',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'alasan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_data',
        'value' => 'data.namalengkap',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'disetujui',
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' => ['1'=>'Sudah Disetujui',''=>'Belum di Setujui'],
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'status'],
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => "{view}&nbsp;{update}&nbsp;{cetak}&nbsp;{delete}",
        'urlCreator' => function($action, $model, $key, $index) {
                return Url::to([$action,'id'=>$key]);
        },
        'buttons' => [
            'cetak' => function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/pengajuanijin/cetak?id=' . $model->id;
                return Html::a('<span class="glyphicon glyphicon-print"></span>', Url::to($t), ['data-pjax'=>0,'target'=>'_blank']);
            },
            'view' => function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/pengajuanijin/view?id=' . $model->id;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($t), ['role' => 'modal-remote','data-target'=>'#'.$idmodal, 'title' => 'View', 'data-toggle' => 'tooltip']);
            },
            'update' => function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/pengajuanijin/update?id=' . $model->id;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target'=>'#'.$idmodal, 'title' => 'Update', 'data-toggle' => 'tooltip']);
            },
            'delete' => function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/pengajuanijin/delete?id=' . $model->id;
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

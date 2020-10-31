<?php
use yii\helpers\Url;
use yii\helpers\Html;
return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],[
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'unit',
        'value'=>'data.riwayatjabatan.unitKerja.unit',
        'label'=>'Unit Kerja'
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'jabatan',
        'value'=>'data.riwayatjabatan.jabatan.nama_referensi',
        'label'=>'Jabatan'
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_data',
        'value' => 'data.namalengkap',
    ],[
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tanggalPengajuan',
    ],[
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tanggalMulai',
    ],[
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tanggalAkhir',
    ],[
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'alasan',
    ],[
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'approval1',
        'value' => 'approval10.namalengkap',
    ],
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

            },
        ],
    ],

];

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
        'attribute'=>'nip',
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama',
        'value'=>'namalengkap'
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tempatLahir',
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tanggalLahir',
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'alamat',
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kabupatenKota',
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kecamatan',
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kelurahan',
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'jenisKelamin',
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'agama',
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'telp',
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'statusPerkawinan',
    ],[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nik',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'golonganDarah',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status_hubungan_keluarga',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'checklog_id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'jenis_pegawai',
            'value'=>'jenispegawai.nama_referensi',
            'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
            'filter' =>\yii\helpers\ArrayHelper::map(\app\models\MReferensi::find()->where(['tipe_referensi'=>'1','status'=>'1'])->all(), 'nama_referensi','nama_referensi'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'jenis pegawai'],
    ],
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
                $t = '@web/pegawai/view?id=' . $model->id_data;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($t), ['role' => 'modal-remote','data-target'=>'#'.$idmodal, 'title' => 'View', 'data-toggle' => 'tooltip']);
            },
            'update' => function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/pegawai/update?id=' . $model->id_data;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target'=>'#'.$idmodal, 'title' => 'Update', 'data-toggle' => 'tooltip']);
            },
            'delete' => function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/pegawai/delete?id=' . $model->id_data;
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
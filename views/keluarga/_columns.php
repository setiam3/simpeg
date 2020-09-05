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
        'attribute'=>'Nama Pegawai',
        'value'=>function($data){
            return $data->parent->nama;
        }
    ],
    'nama:raw:Nama Anggota Keluarga',
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tempatLahir',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tanggalLahir',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'alamat',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'kabupatenKota',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'kecamatan',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'kelurahan',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'jenisKelamin',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'agama',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'telp',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'email',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'statusPerkawinan',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'gelarDepan',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'gelarBelakang',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'nik',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'foto',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fotoNik',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'golonganDarah',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status_hubungan_keluarga',
        'value'=>'statusHubunganKeluarga.nama_referensi'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'buttons'=>[
            'view'=>function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/keluarga/view?id='.$model->id_data;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',Url::to($t),['role'=>'modal-remote','data-target'=>'#'.$idmodal,'title'=>'View','data-toggle'=>'tooltip']);
            },
            'update'=>function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/keluarga/update?id='.$model->id_data;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>',Url::to($t),['role'=>'modal-remote','data-target'=>'#'.$idmodal,'title'=>'Update', 'data-toggle'=>'tooltip']);
            },
            'delete'=>function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/keluarga/delete?id='.$model->id_data;
                return Html::a('<span class="glyphicon glyphicon-trash"></span>',Url::to($t),['role'=>'modal-remote','data-target'=>'#'.$idmodal,'title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item']);
            },
        ], 
    ],

];   
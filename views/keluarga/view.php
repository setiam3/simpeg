<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MBiodata */
?>
<div class="mbiodata-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'id_data',


            [
                'attribute' => 'parent_id',
                'value' => function ($data) {
                    return $data->parent->nama;
                },
            ],
            'nip',
            'nama',
            'tempatLahir',
            'tanggalLahir',
            'alamat',



            [
                'attribute' => 'kabupatenKota',
                'value' => function ($data) {
                    return $data->desanya->district->regency->name;
                },
            ],

            [
                'attribute' => 'kecamatan',
                'value' => function ($data) {
                    return $data->desanya->district->name;
                },
            ],
            [
                'attribute' => 'kelurahan',
                'value' => function ($data) {
                    return $data->desanya->name;
                },
            ],


            [
                'attribute' => 'jenisKelamin',
                'value' => function ($data) {
                    return $data->sex->nama_referensi;
                },
            ],
            [
                'attribute' => 'agama',
                'value' => function ($data) {
                    return $data->agamanya->nama_referensi;
                },
            ],
            'telp',
            'email:email',
            //'statusPerkawinan',
            [
                'attribute' => 'statusPerkawinan',
                'value' => function ($data) {
                    return $data->statuskawin->nama_referensi;
                },
            ],
            'gelarDepan',
            'gelarBelakang',
            'nik',
            [
                'attribute' => 'foto',
                'format' => 'raw',
                'value' => \yii\helpers\Html::a($model->foto, ['uploads/foto/' . $model->parent->nip . '/' . $model->foto])

            ],
            [
                'attribute' => 'fotoNik',
                'format' => 'raw',
                'value' => \yii\helpers\Html::a($model->fotoNik, ['uploads/foto/' . $model->parent->nip . '/'  . $model->fotoNik])

            ],
            'golonganDarah',
            //'status_hubungan_keluarga',
            [
                'attribute' => 'status_hubungan_keluarga',
                'value' => function ($data) {
                    return $data->statusHubunganKeluarga->nama_referensi;
                },
            ],
            'is_pegawai',
            'checklog_id',
        ],
    ]) ?>
</div>
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
            'parent_id',
            'nip',
            'nama',
            'tempatLahir',
            'tanggalLahir',
            'alamat',
            'kabupatenKota',
            'kecamatan',
            'kelurahan',
            'jenisKelamin',
            'agama',
            'telp',
            'email:email',
            'statusPerkawinan',
            'gelarDepan',
            'gelarBelakang',
            'nik',
            [
                'attribute' => 'foto',
                'format' => 'raw',
                'value' => \yii\helpers\Html::a($model->foto, ['uploads/foto' . $model->parent->nip . '/' . $foto = 'foto_' . $model->status_hubungan_keluarga . '_' . $model->parent_id])

            ],
            [
                'attribute' => 'fotoNik',
                'format' => 'raw',
                'value' => \yii\helpers\Html::a($model->fotoNik, ['uploads/foto/' . $model->parent->nip . '/' . $fotoNik = 'fotoNik_' . $model->status_hubungan_keluarga . '_' . $model->nik])

            ],
            'golonganDarah',
            'status_hubungan_keluarga',
            'is_pegawai',
            'checklog_id',
        ],
    ]) ?>

</div>
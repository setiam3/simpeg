<?php

use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model app\models\Riwayatpendidikan */
?>
<div class="riwayatpendidikan-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'data.nama',
            [
                'attribute' => 'tingkatPendidikan',
                'value' => function ($data) {
                    return $data->tingpen->nama_referensi;
                },
            ],
            'jurusan',
            'namaSekolah',
            'thLulus',
            [
                'attribute' => 'dokumen',
                'format' => 'raw',
                'value' => \yii\helpers\Html::a($model->dokumen, ['uploads/foto/' . $model->data->nip . '/' . $model->dokumen])

            ],
            'no_ijazah',
            'tgl_ijazah',
            'thMasuk',
            'medis',
            'suratijin',
            'tgl_berlaku_ijin',
        ],
    ]) ?>

</div>
<?php

use yii\widgets\DetailView;
?>
<div class="pengajuanijin-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tanggalPengajuan',
            'tanggalMulai',
            'tanggalAkhir',
            'alasan',
            [
                'attribute' => 'Karyawan',
                'value' => function ($data) {
                    return $data->data->namalengkap;
                },
            ],
            [
                'attribute' => 'approval1',
                'value' => function ($data) {
                    return isset($data->approval10->nama) ? $data->approval10->namalengkap : 'Pending';
                },
            ],
            [
                'attribute' => 'approval2',
                'value' => function ($data) {
                    return isset($data->approval20->nama) ? $data->approval20->namalengkap : 'Pending';
                },
            ],
            'disetujui',
            [
                'attribute' =>  'jenisIjin',
                'value' => function ($data) {
                    return $data->jen['nama_referensi'];
                },
            ],
            'keterangan',
            ['attribute' => 'shift', 'value' => function ($data) {
                return $data->shift ? 'Shift' : 'Non Shift';
            }]
        ],
    ]) ?>

</div>
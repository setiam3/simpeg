<?php

use yii\widgets\DetailView;



?>
<div class="pengajuanijin-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'Karyawan',
                'value' => function ($data) {
                    return $data->data->nama;
                },
            ],
            'tanggalPengajuan',
            'tanggalMulai',
            'tanggalAkhir',
            'alasan',
            [
                'attribute' => 'approval1',
                'value' => function ($data) {
                    return !empty($data->approval1)?$data->approval10->nama:'';
                },
            ],
            'disetujui',
            'jenisIjin',
        ],
    ]) ?>

</div>

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
                    return $data->data->namalengkap;

                },
            ],
            'tanggalPengajuan',
            'tanggalMulai',
            'tanggalAkhir',
            'alasan',
            'jenisIjin',
        ],
    ]) ?>

</div>

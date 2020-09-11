<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pengajuanijin */
?>
<div class="pengajuanijin-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
            //            'id_data',
            [
                'attribute' => 'approval1',
                'value' => function ($data) {
                    return $data->approval10->nama;
                },
            ],
            'approval2',
            'disetujui',
            'jenisIjin',
        ],
    ]) ?>

</div>
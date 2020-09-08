<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pengajuanijin */
?>
<div class="pengajuanijin-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'tanggalPengajuan',
            'tanggalMulai',
            'tanggalAkhir',
            'alasan',
//            'id_data',
            [
                'attribute' => 'Karyawan',
                'value' => function ($data) {
                    return $data->data->nama;

                },
            ],
            'approval1',
            'approval2',
            'disetujui',
            'jenisIjin',
        ],
    ]) ?>

</div>
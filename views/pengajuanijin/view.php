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

            [
                'attribute' => 'approval1',
                'value' => function ($data) {
                    if (!empty($data->approval10->nama)){
                        return $data->approval10->nama;
                    }else{
                        return 'Pending';
                    }

                },
            ],
            [
                'attribute' => 'approval2',
                'value' => function ($data) {
                if (!empty($data->approval20->nama)){
                    return $data->approval20->nama;
                }else{
                    return 'Pending';
                }

                },
            ],
            'disetujui',
            'jenisIjin',
        ],
    ]) ?>

</div>

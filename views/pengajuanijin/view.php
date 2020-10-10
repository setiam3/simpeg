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
                    if (!empty($data->approval10->nama)){
                        return $data->approval10->namalengkap;
                    }else{
                        return 'Pending';
                    }

                },
            ],
            [
                'attribute' => 'approval2',
                'value' => function ($data) {
                if (!empty($data->approval20->nama)){
                    return $data->approval20->namalengkap;
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

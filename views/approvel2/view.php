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
            [
                'attribute' => 'approval1',
                'value' => function ($data) {
                    return !empty($data->approval1)?$data->approval10->namalengkap:'';
                },
            ],
            [
                'attribute' => 'approval2',
                'value' => function ($data) {
                    return !empty($data->approval2)?$data->approval20->namalengkap:'';
                },
            ],
            'disetujui',
            'jenisIjin',
            'keterangan',
            ['attribute'=>'shift','value'=>function($data){
                return $data->shift?'Shift':'Non Shift';
            }]
        ],
    ]) ?>

</div>

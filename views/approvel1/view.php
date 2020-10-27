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
            'keterangan',
            ['attribute'=>'approval1','value'=>function($data){
                return (isset($data->approval1))?$data->approval10->namalengkap:'';
            }],
            ['attribute'=>'shift','value'=>function($data){
                return $data->shift?'Shift':'Non Shift';
            }]
        ],
    ]) ?>
</div>

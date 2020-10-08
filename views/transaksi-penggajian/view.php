<?php
use app\models\TransaksiPenggajian;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
?>
<div class="transaksi-penggajian-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'data_id',
                'value' => function ($data) {
                    return $data->data->namalengkap;
                },
            ],
            'nomor_transgaji',
            'tgl_gaji',
            'pelaksana_id',
            'tgl_input',
            'total_brutto_gaji',

            // [
            //     'attribute' => 'gol gaji',
            //     'value' => implode(ArrayHelper::map($model->trandetail, 'transgaji_id', 'gol_gaji'))
            // ],
            // [
            //     'attribute' => 'tunjangan id',
            //     'value' => implode(ArrayHelper::map($model->trandetail, 'transgaji_id', 'tunjangan_id'))
            // ],
            [
                'attribute' => 'total tunjangan',
                 'value' => $model->totaltunjangan
            ],
            [
                'attribute'=>'total pinjaman',
                'value'=>$model->totalpinjaman
            ],
            // [
            //     'attribute' => 'potongan desc',
            //     'value' => function ($data) { return $data->potongangajiss->potongan_desc;}
            // ],
            [
                'attribute' => 'total potongan',
                'value' =>$model->totalpotongan
            ],
            // [
            //     'attribute' => 'keterangan',
            //     'value' => implode(ArrayHelper::map($model->potongangajis, 'transgaji_id', 'keterangan'))
            // ],
            'total_bersih_gaji',
        ],
    ]) ?>

</div>

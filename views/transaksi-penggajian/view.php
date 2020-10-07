<?php
use app\models\TransaksiPenggajian;
use yii\widgets\DetailView;
?>
<div class="transaksi-penggajian-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'data_id',
                'value' => function ($data) {
                    return $data->data->nama;
                },
            ],
            'nomor_transgaji',
            'tgl_gaji',
            'pelaksana_id',
            'tgl_input',
            'total_brutto_gaji',
            'total_bersih_gaji',
            [
                'attribute' => 'gol gaji',
                'value' => implode(\yii\helpers\ArrayHelper::map($model->trandetail, 'transgaji_id', 'gol_gaji'))
            ],
            [
                'attribute' => 'tunjangan id',
                'value' => implode(\yii\helpers\ArrayHelper::map($model->trandetail, 'transgaji_id', 'tunjangan_id'))
            ],
            [
                'attribute' => 'nominal val',
                'value' => implode(\yii\helpers\ArrayHelper::map($model->trandetail, 'transgaji_id', 'nominal_val'))
            ],
            [
                'attribute' => 'potongan desc',
                'value' => function ($data) { return $data->potongangajiss->potongan_desc;}
            ],
            [
                'attribute' => 'potongan nominal',
                'value' => implode(\yii\helpers\ArrayHelper::map($model->potongangajis, 'transgaji_id', 'potongan_nominal'))
            ],
            [
                'attribute' => 'keterangan',
                'value' => implode(\yii\helpers\ArrayHelper::map($model->potongangajis, 'transgaji_id', 'keterangan'))
            ],
        ],
    ]) ?>

</div>

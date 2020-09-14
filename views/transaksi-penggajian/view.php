<?php

use app\models\TransaksiPenggajian;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiPenggajian */
?>
<div class="transaksi-penggajian-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            //'transgaji_id',
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
//                'value' => function($data){
//        return $data->transdetail->gol_gaji;
//                }
                'value' => implode(\yii\helpers\ArrayHelper::map($model->trandetail, 'transgaji_id', 'tunjangan_id'))
            ],
            [
                'attribute' => 'nominal val',
                'value' => implode(\yii\helpers\ArrayHelper::map($model->trandetail, 'transgaji_id', 'nominal_val'))
            ],
            [
                'attribute' => 'potongan desc',
//                'value' => implode(\yii\helpers\ArrayHelper::map($model->potongangajis->potonganDesc, 'potongan_desc', 'nama_referensi'))
                'value' => function ($data) {$data->potongangajiss->potonganDesc->nama_referensi;}
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

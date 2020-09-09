<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiPenggajian */
?>
<div class="transaksi-penggajian-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'transgaji_id',
            [
                'attribute' => 'Karyawan',
                'value' => function ($data) {
                    return $data->data->nama;

                },
            ],
            'nomor_transgaji',
            'tgl_gaji',
//            'pelaksana_id',
            'tgl_input',
            'total_brutto_gaji',
            'total_bersih_gaji',
            'transgaji_id',

        ],
    ]) ?>

</div>

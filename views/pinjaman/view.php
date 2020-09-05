<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MPinjaman */
?>
<div class="mpinjaman-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute' => 'Karyawan',
                'value' => function ($data) {
                    return $data->data->nama;
                },
            ],
            'tanggal',
            'jenis',
            'namaBarang',
            'jumlah',
        ],
    ]) ?>

</div>
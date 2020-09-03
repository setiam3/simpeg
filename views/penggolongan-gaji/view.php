<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MPenggolonganGaji */
?>
<div class="mpenggolongan-gaji-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'Pangkat / Golongan',
                'value' => function ($data) {
                    return $data->pangkat->nama_referensi;

                },
            ],
            'masa_kerja',
            'gaji',
            'status_penggolongan',
            [
                'attribute' => 'jenis_pegawai',
                'value' => function ($data) {
                    return $data->jenisPegawai->nama_referensi;

                },
            ],
        ],
    ]) ?>

</div>

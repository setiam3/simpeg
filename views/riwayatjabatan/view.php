<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Riwayatjabatan */
?>
<div class="riwayatjabatan-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'attribute' => 'Karyawan',
                'value' => function ($data) {
                    return $data->data->nama;

                },
            ],
            [
                'attribute' => 'Jabatan',
                'value' => function ($data) {
                    return $data->jabatan->nama_referensi;

                },
            ],
            'eselon',
            'noSk',
            'tglSk',
            'tmtJabatan',
            'dokumen',
            [
                'attribute' => 'Unit Kerja',
                'value' => function ($data) {
                    return $data->unitKerja->unit;

                },
            ],
        ],
    ]) ?>

</div>

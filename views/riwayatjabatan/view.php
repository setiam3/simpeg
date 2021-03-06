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
            [
                'attribute' => 'dokumen',
                'format' => 'raw',
                'value' => \yii\helpers\Html::a($model->dokumen, ['uploads/foto/' . $model->data->nip . '/' . $model->dokumen])

            ],
            [
                'attribute' => 'Unit Kerja',
                'value' => function ($data) {
                    return $data->unitKerja->unit;
                },
            ],
        ],
    ]) ?>

</div>
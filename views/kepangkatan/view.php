<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MKepangkatan */
?>
<div class="mkepangkatan-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'Karyawan',
                'value' => function ($data) {
                    return $data->data->nama;

                },
            ],
            'ditetapkanOleh',
            'noSk',
            'tglSk',
            'penggolongangaji_id',
            [
                'attribute' => 'Golongan',
                'value' => function ($data) {
                    return $data->penggolongangaji->pangkat->nama_referensi;

                },
            ],
            'tmtPangkat',
            'tmt',
            'dokumen',
        ],
    ]) ?>

</div>

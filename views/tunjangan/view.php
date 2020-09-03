<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MTunjangan */
?>
<div class="mtunjangan-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'tunjangan_id',
            [
                'attribute' => 'Tunjangan',
                'value' => function ($data) {
                    return $data->tunjangan->nama_referensi;

                },
            ],
            'nominal',
            'status',
//            'id_data',
            [
                'attribute' => 'Karyawan',
                'value' => function ($data) {
                    return $data->data->nama;

                },
            ],
        ],
    ]) ?>

</div>

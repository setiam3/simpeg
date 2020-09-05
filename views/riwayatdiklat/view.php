<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MRiwayatdiklat */
?>
<div class="mriwayatdiklat-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute' => 'karyawan',
                'value' => function ($data) {
                    return $data->data->nama;
                },
            ],
            'namaDiklat',
            'tempat',
            'penyelenggara',
            'mulai',
            'selesai',
            'dokumen',
        ],
    ]) ?>

</div>
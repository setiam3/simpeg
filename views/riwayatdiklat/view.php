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
            [
                'attribute' => 'dokumen',
                'format' => 'raw',
                'value' => \yii\helpers\Html::a($model->dokumen, ['uploads/foto/' . $model->data->nip . '/' . $model->dokumen])

            ],
        ],
    ]) ?>

</div>
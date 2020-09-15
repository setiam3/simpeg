<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MRekening */
?>
<div class="mrekening-view">

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
            [
                'attribute' => 'Nama Bank',
                'value' => function ($data) {
                    return $data->bank->nama_referensi;
                },
            ],
            'nomor_rekening',
            'npwp',
            [
                'attribute' => 'fotoNpwp',
                'format' => 'raw',
                'value' => \yii\helpers\Html::a($model->fotoNpwp, ['uploads/foto/'.$model->data->nip.'/'.$model->fotoNpwp])

            ],
            [
                'attribute' => 'fotoRekening',
                'format' => 'raw',
                'value' => \yii\helpers\Html::a($model->fotoRekening, ['uploads/foto/'.$model->data->nip.'/'.$model->fotoRekening])
            ],
        ],
    ]) ?>

</div>

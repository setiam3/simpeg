<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Riwayatpendidikan */
?>
<div class="riwayatpendidikan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'data.nama',
            'tingkatPendidikan',
            'jurusan',
            'namaSekolah',
            'thLulus',
            'dokumen',
            'no_ijazah',
            'tgl_ijazah',
            'thMasuk',
            'medis',
            'suratijin',
            'tgl_berlaku_ijin',
        ],
    ]) ?>

</div>

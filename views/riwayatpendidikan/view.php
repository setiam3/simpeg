<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Riwayatpendidikan */
?>
<div class="riwayatpendidikan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_data',
            'tingkatPendidikan',
            'jurusan',
            'namaSekolah',
            'thLulus',
            'dokumen',
            'no_ijazah',
            'tgl_ijazah',
            'thMasuk',
        ],
    ]) ?>

</div>

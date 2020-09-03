<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MPinjaman */
?>
<div class="mpinjaman-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_data',
            'tanggal',
            'jenis',
            'namaBarang',
            'jumlah',
        ],
    ]) ?>

</div>

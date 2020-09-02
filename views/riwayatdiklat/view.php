<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MRiwayatdiklat */
?>
<div class="mriwayatdiklat-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_data',
            'namaDiklat',
            'tempat',
            'penyelenggara',
            'mulai',
            'selesai',
            'dokumen',
        ],
    ]) ?>

</div>

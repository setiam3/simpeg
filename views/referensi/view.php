<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MReferensi */
?>
<div class="mreferensi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'reff_id',
            'nama_referensi',
            'tipe_referensi',
            'status',
        ],
    ]) ?>

</div>

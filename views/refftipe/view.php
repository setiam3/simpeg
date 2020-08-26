<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MReffTipe */
?>
<div class="mreff-tipe-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tipereff_id',
            'nama_reff_tipe',
            'status',
        ],
    ]) ?>

</div>

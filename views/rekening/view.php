<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MRekening */
?>
<div class="mrekening-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_data',
            'bank_id',
            'nomor_rekening',
            'npwp',
            'fotoNpwp',
            'fotoRekening',
        ],
    ]) ?>

</div>

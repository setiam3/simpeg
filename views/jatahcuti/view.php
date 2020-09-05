<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Jatahcuti */
?>
<div class="jatahcuti-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_data',
            'jumlah',
            'sisa',
        ],
    ]) ?>

</div>

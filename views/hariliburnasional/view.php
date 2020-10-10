<?php

use yii\widgets\DetailView;
?>
<div class="hariliburnasional-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tahun',
            'tanggal',
            'keterangan',
        ],
    ]) ?>

</div>

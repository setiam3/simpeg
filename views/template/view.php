<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MsTemplate */
?>
<div class="ms-template-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'indikator',
            'bobot',
            'target',
            'keterangan',
            'parent',
            'idunit',
        ],
    ]) ?>

</div>

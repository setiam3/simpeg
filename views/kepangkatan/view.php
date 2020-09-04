<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MKepangkatan */
?>
<div class="mkepangkatan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_data',
            'ditetapkanOleh',
            'noSk',
            'tglSk',
            'penggolongangaji_id',
            'tmtPangkat',
            'ruang',
            'fk_golongan',
            'tmt',
            'dokumen',
        ],
    ]) ?>

</div>

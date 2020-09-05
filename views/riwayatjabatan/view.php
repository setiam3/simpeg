<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Riwayatjabatan */
?>
<div class="riwayatjabatan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_data',
            'id_jabatan',
            'eselon',
            'noSk',
            'tglSk',
            'tmtJabatan',
            'dokumen',
            'unit_kerja',
        ],
    ]) ?>

</div>

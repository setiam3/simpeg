<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MsFormula */
?>
<div class="ms-formula-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'idpekerjaan0.nama_pekerjaan',
            'estimasi',
            'total_score',
//            'id_bobot',
        ],
    ]) ?>

</div>

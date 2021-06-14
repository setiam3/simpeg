<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MsFormula */
?>
<div class="ms-formula-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'idpekerjaan',
            'estimasi',
            'total_score',
            'id_bobot',
        ],
    ]) ?>

</div>

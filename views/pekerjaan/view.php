<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MsPekerjaan */
?>
<div class="ms-pekerjaan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama_pekerjaan',
            'status',
        ],
    ]) ?>

</div>

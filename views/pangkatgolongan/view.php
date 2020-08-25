<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MPangkatgolongan */
?>
<div class="mpangkatgolongan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'jenis',
            'golongan',
            'ruang',
        ],
    ]) ?>

</div>

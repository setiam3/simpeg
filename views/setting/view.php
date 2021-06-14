<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Setting */
?>
<div class="setting-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'param',
            'value',
            'data',
        ],
    ]) ?>

</div>

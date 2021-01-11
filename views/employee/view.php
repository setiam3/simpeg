<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
?>
<div class="employee-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'gender',
            'address',
            'status',
        ],
    ]) ?>

</div>

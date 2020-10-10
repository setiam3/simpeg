<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Jatahcuti */
?>
<div class="jatahcuti-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'id_data','value'=>function($model){
                return $model->data->namalengkap;
            }],
            'sisa',
        ],
    ]) ?>

</div>

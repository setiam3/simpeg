<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MsBobot */
?>
<div class="ms-bobot-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'level',
            'uraian:ntext',
            'bobot',
            'nilai_rasio',
            'kategory',
        ],
    ]) ?>

</div>

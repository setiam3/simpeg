<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MUnit */
?>
<div class="munit-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'kode',
            'unit',
            'fk_instalasi',
            'is_vip',
            'aktif',
        ],
    ]) ?>

</div>

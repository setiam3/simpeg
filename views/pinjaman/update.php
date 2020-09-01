<?php

use yii\helpers\Html;

$this->title = 'Update Pinjaman: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pinjaman', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mpinjaman-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

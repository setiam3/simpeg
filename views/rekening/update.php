<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MRekening */

$this->title = 'Update Rekening: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rekening', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mrekening-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
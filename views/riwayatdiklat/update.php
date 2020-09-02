<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MRiwayatdiklat */

$this->title = 'Update Data Riwayat Diklat: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'M Riwayatdiklats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mriwayatdiklat-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
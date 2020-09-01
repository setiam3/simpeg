<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MPenggolongangaji */

$this->title = 'Update Penggolongangaji: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penggolongangaji', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mpenggolongangaji-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

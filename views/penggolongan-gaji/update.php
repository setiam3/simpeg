<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MPenggolonganGaji */

$this->title = 'Update M Penggolongan Gaji: ' . $model->pangkat->nama_referensi;
$this->params['breadcrumbs'][] = ['label' => 'M Penggolongan Gajis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mpenggolongan-gaji-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

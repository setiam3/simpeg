<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MmasterchecklogPegawai */

$this->title = 'Update Mmasterchecklog Pegawai: ' . $model->checklogpegawai_id;
$this->params['breadcrumbs'][] = ['label' => 'Mmasterchecklog Pegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->checklogpegawai_id, 'url' => ['view', 'id' => $model->checklogpegawai_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mmasterchecklog-pegawai-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

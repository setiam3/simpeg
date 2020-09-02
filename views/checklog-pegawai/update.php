<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MchecklogPegawai */

$this->title = 'Update Mchecklog Pegawai: ' . $model->cheklog_id;
$this->params['breadcrumbs'][] = ['label' => 'Mchecklog Pegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cheklog_id, 'url' => ['view', 'id' => $model->cheklog_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mchecklog-pegawai-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

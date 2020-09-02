<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MmasterchecklogPegawai */

$this->title = 'Create Mmasterchecklog Pegawai';
$this->params['breadcrumbs'][] = ['label' => 'Mmasterchecklog Pegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mmasterchecklog-pegawai-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

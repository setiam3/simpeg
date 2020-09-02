<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MchecklogPegawai */

$this->title = 'Create Mchecklog Pegawai';
$this->params['breadcrumbs'][] = ['label' => 'Mchecklog Pegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mchecklog-pegawai-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

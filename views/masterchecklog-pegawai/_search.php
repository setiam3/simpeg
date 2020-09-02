<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MmasterchecklogPegawaiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mmasterchecklog-pegawai-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'checklogpegawai_id') ?>

    <?= $form->field($model, 'id_data') ?>

    <?= $form->field($model, 'nama_checklogpegawai') ?>

    <?= $form->field($model, 'status_checklogpegawai') ?>

    <?= $form->field($model, 'nip') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

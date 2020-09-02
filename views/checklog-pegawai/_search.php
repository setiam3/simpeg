<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MchecklogPegawaiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mchecklog-pegawai-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cheklog_id') ?>

    <?= $form->field($model, 'checklogpegawai_id') ?>

    <?= $form->field($model, 'kedatangan') ?>

    <?= $form->field($model, 'pulang') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

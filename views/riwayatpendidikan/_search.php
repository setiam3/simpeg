<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RiwayatpendidikanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="riwayatpendidikan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_data') ?>

    <?= $form->field($model, 'tingkatPendidikan') ?>

    <?= $form->field($model, 'jurusan') ?>

    <?= $form->field($model, 'namaSekolah') ?>

    <?php // echo $form->field($model, 'thLulus') ?>

    <?php // echo $form->field($model, 'dokumen') ?>

    <?php // echo $form->field($model, 'no_ijazah') ?>

    <?php // echo $form->field($model, 'tgl_ijazah') ?>

    <?php // echo $form->field($model, 'thMasuk') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

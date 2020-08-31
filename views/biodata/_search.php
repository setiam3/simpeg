<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MBiodataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mbiodata-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_data') ?>

    <?= $form->field($model, 'parent_id') ?>

    <?= $form->field($model, 'nip') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'tempatLahir') ?>

    <?php // echo $form->field($model, 'tanggalLahir') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'kabupatenKota') ?>

    <?php // echo $form->field($model, 'kecamatan') ?>

    <?php // echo $form->field($model, 'kelurahan') ?>

    <?php // echo $form->field($model, 'jenisKelamin') ?>

    <?php // echo $form->field($model, 'agama') ?>

    <?php // echo $form->field($model, 'telp') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'statusPerkawinan') ?>

    <?php // echo $form->field($model, 'gelarDepan') ?>

    <?php // echo $form->field($model, 'gelarBelakang') ?>

    <?php // echo $form->field($model, 'nik') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'fotoNik') ?>

    <?php // echo $form->field($model, 'golonganDarah') ?>

    <?php // echo $form->field($model, 'status_hubungan_keluarga') ?>

    <?php // echo $form->field($model, 'is_pegawai') ?>

    <?php // echo $form->field($model, 'checklog_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

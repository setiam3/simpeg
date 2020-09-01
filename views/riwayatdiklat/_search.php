<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MRiwayatdiklatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mriwayatdiklat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_data') ?>

    <?= $form->field($model, 'namaDiklat') ?>

    <?= $form->field($model, 'tempat') ?>

    <?= $form->field($model, 'penyelenggara') ?>

    <?php // echo $form->field($model, 'mulai') ?>

    <?php // echo $form->field($model, 'selesai') ?>

    <?php // echo $form->field($model, 'dokumen') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

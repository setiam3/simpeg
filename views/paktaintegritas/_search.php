<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaktaintegritasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paktaintegritas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nomer') ?>

    <?= $form->field($model, 'id_data') ?>

    <?= $form->field($model, 'jabatan') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'ttd') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

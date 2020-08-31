<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MRekeningSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mrekening-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_data') ?>

    <?= $form->field($model, 'bank_id') ?>

    <?= $form->field($model, 'nomor_rekening') ?>

    <?= $form->field($model, 'npwp') ?>

    <?php // echo $form->field($model, 'fotoNpwp') ?>

    <?php // echo $form->field($model, 'fotoRekening') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

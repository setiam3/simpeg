<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MRiwayarjabatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mriwayatjabatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nip') ?>

    <?= $form->field($model, 'namaJabatan') ?>

    <?= $form->field($model, 'eselon') ?>

    <?= $form->field($model, 'noSk') ?>

    <?php // echo $form->field($model, 'tglSk') ?>

    <?php // echo $form->field($model, 'tmtJabatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

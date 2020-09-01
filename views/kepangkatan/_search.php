<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MKepangkatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mkepangkatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_data') ?>

    <?= $form->field($model, 'ditetapkanOleh') ?>

    <?= $form->field($model, 'noSk') ?>

    <?= $form->field($model, 'tglSk') ?>

    <?php // echo $form->field($model, 'penggolongangaji_id') ?>

    <?php // echo $form->field($model, 'tmtPangkat') ?>

    <?php // echo $form->field($model, 'ruang') ?>

    <?php // echo $form->field($model, 'fk_golongan') ?>

    <?php // echo $form->field($model, 'tmt') ?>

    <?php // echo $form->field($model, 'dokumen') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

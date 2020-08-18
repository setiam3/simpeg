<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MRiwayatjabatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mriwayatjabatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'namaJabatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eselon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noSk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglSk')->textInput() ?>

    <?= $form->field($model, 'tmtJabatan')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

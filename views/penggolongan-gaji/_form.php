<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\MPenggolonganGaji */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mpenggolongan-gaji-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pangkat_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MReferensi::findAll(['tipe_referensi'=>'6']),'reff_id','nama_referensi'),
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Pangkat'); ?>

    <?= $form->field($model, 'masa_kerja')->textInput() ?>

    <?= $form->field($model, 'gaji')->widget(\yii\widgets\MaskedInput::className(), [
        'clientOptions' => [
            'alias' => 'numeric',
            'digits' => 2,
            'digitsOptional' => false,
            'radixPoint' => '.',
            'groupSeparator' => ',',
            'autoGroup' => true,
            'removeMaskOnSubmit' => true,
        ],
    ])?>

    <?= $form->field($model, 'status_penggolongan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

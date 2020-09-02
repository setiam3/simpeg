<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use kartik\widgets\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\MchecklogPegawai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mchecklog-pegawai-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'checklogpegawai_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\MmasterchecklogPegawai::find()->all(), 'checklogpegawai_id', 'nama_checklogpegawai'),
        'options' => ['placeholder' => 'Select nama pegawai ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Nama Pegawai') ?>

    <?= $form->field($model, 'kedatangan')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Enter event time ...'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'pulang')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Enter event time ...'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

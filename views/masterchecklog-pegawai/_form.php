<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\widgets\SwitchInput;
/* @var $this yii\web\View */
/* @var $model app\models\MmasterchecklogPegawai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mmasterchecklog-pegawai-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'nip')->textInput() ?>
    <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai'=>1])->all(), 'id_data', 'nama'),
        'options' => ['placeholder' => 'Select id_data ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Nama Pegawai') ?>

    <?= $form->field($model, 'checklogpegawai_id')->textInput()->label('Kode Checklog') ?>
    <?= $form->field($model, 'nama_checklogpegawai')->textInput() ?>
    <?= $form->field($model, 'status_checklogpegawai')->widget(SwitchInput::classname(),['pluginOptions'=>[
        'handleWidth'=>60,'onText'=>'Aktif','offText'=>'Tidak'
    ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

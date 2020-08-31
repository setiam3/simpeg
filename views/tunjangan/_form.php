<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\MTunjangan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mtunjangan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tunjangan_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MReferensi::findAll(['tipe_referensi'=>'4']),'reff_id','nama_referensi'),
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Tunjangan'); ?>

    <?= $form->field($model, 'nominal')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MBiodata::findAll(['is_pegawai'=>'1']),'id_data','nama'),
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Nama Pegawai'); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

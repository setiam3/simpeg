<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MKepangkatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mkepangkatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_data')->textInput() ?>
    <?= $form->field($model, 'id_data')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MBiodata::findAll(['is_pegawai'=>'1']),'id_data','nama'),
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Nama Pegawai'); ?>

    <?= $form->field($model, 'ditetapkanOleh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noSk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglSk')->textInput() ?>

    <?= $form->field($model, 'penggolongangaji_id')->textInput() ?>

    <?= $form->field($model, 'tmtPangkat')->textInput() ?>

    <?= $form->field($model, 'ruang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_golongan')->textInput() ?>

    <?= $form->field($model, 'tmt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dokumen')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

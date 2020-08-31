<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\MRekening */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mrekening-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\MBiodata::find()->all(), 'id_data', 'nama'),
        'options' => ['placeholder' => 'Select id_data ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>

    <?= $form->field($model, 'bank_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\MReferensi::find()->where(['tipe_referensi' => '5'])->all(), 'reff_id', 'nama_referensi'),
        'options' => ['placeholder' => 'Select bank id ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>

    <?= $form->field($model, 'nomor_rekening')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'npwp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fotoNpwp')->fileInput() ?>

    <?= $form->field($model, 'fotoRekening')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
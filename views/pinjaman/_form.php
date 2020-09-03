<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\MPinjaman */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mpinjaman-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\MBiodata::find()->all(), 'id_data', 'nama'),
        'options' => ['placeholder' => 'Select id_data ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>

    <?= $form->field($model, 'jenis')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\MReferensi::find()->where(['tipe_referensi' => '11'])->all(), 'reff_id', 'nama_referensi'),
        'options' => ['placeholder' => 'Select Jenis ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Bank')
    ?>

    <?= $form->field($model, 'namaBarang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'masukan tanggal'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => true]) ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
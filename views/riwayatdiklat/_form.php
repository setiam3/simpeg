<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\MRiwayatdiklat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mriwayatdiklat-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-xs-6">
            <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\MBiodata::find()->all(), 'id_data', 'nama'),
                'options' => ['placeholder' => 'Select id_data ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])
            ?>

            <?= $form->field($model, 'namaDiklat')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tempat')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'penyelenggara')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'mulai')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'masukan tanggal Mulai'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>

            <?= $form->field($model, 'selesai')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'masukan tanggal Selesai'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>
        </div>
        <div class="col-xs-5">
            <?php
            if (!$model->isNewRecord) {
                $linkdokumen = \Yii::getAlias('@web/uploads/foto/' . $model->data->nip . '/' . $model->dokumen);
                if (file_exists(\Yii::getAlias('@uploads') . $model->data->nip . '/' . $model->dokumen) && !empty($model->dokumen)) {
                    echo Html::a(Html::img($linkdokumen, ['class' => 'col-xs-12']), $linkdokumen);
                }
            }
            ?>
            <?= $form->field($model, 'dokumen')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*', 'application/pdf'],
                'pluginOptions' => [
                    'maxFileSize' => 2048,
                    'showPreview' => $model->isNewRecord,
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'browseClass' => 'btn btn-primary btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' =>  'Select Foto'
                ],
            ]) ?>
            <?php if (!Yii::$app->request->isAjax) { ?>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            <?php } ?>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
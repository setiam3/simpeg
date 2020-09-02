<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\MRekening */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mrekening-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-xs-4">
            <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai' => 1])->all(), 'id_data', 'nama'),
                'options' => ['placeholder' => 'Select id_data ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Nama Pegawai')
            ?>

            <?= $form->field($model, 'bank_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\MReferensi::find()->where(['tipe_referensi' => '5'])->all(), 'reff_id', 'nama_referensi'),
                'options' => ['placeholder' => 'Select bank id ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Bank')
            ?>

            <?= $form->field($model, 'nomor_rekening')->textInput(['maxlength' => true, 'type' => 'number']) ?>

            <?= $form->field($model, 'npwp')->textInput(['maxlength' => true, 'type' => 'number']) ?>
        </div>

        <div class="col-xs-4">
            <?php
            if (!$model->isNewRecord) {
                $linkfotnpwp = \Yii::getAlias('@web/uploads/foto/' . $model->data->nip . '/' . $model->fotoNpwp);
                if (file_exists(\Yii::getAlias('@uploads') . $model->data->nip . '/' . $model->fotoNpwp) && !empty($model->fotoNpwp)) {
                    echo Html::a(Html::img($linkfotnpwp, ['class' => 'col-xs-12']), $linkfotnpwp);
                }
            }
            ?>
            <?= $form->field($model, 'fotoNpwp')->widget(FileInput::classname(), [
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
        </div>

        <div class="col-xs-4">
            <?php
            if (!$model->isNewRecord) {
                $linkfotrek = \Yii::getAlias('@web/uploads/foto/' . $model->data->nip . '/' . $model->fotoRekening);
                if (file_exists(\Yii::getAlias('@uploads') . $model->data->nip . '/' . $model->fotoRekening) && !empty($model->fotoRekening)) {
                    echo Html::a(Html::img($linkfotrek, ['class' => 'col-xs-12']), $linkfotrek);
                }
            }
            ?>
            <?= $form->field($model, 'fotoRekening')->widget(FileInput::classname(), [
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
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

</div>
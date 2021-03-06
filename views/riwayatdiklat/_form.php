<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

$role = \Yii::$app->tools->getcurrentroleuser();
if (in_array('karyawan', $role)) {
    $data = \app\models\MBiodata::findOne(['is_pegawai' => '1', 'id_data' => \Yii::$app->user->identity->id_data]);
    $parent = [$data->id_data => $data->namaLengkap];
} elseif (in_array('operator', $role) || in_array('admin', $role)) {
    if (!empty($klikedid)) {
        $data = \app\models\MBiodata::findOne(['is_pegawai' => '1', 'id_data' => $klikedid]);
        $parent = [$data->id_data => $data->namalengkap];
    } else {
        $parent = ArrayHelper::map(\app\models\MBiodata::findAll(['is_pegawai' => '1']), 'id_data', 'namaLengkap');
    }
}

?>
<div class="mriwayatdiklat-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-xs-6">
            <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
                'data' => $parent,
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
        <div class="col-xs-6">
            <?= $form->field($model, 'dokumen')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*', 'application/pdf', 'autoReplace' => true],
                'pluginOptions' => [
                    'initialPreview' => (!$model->isNewRecord && isset($model->dokumen)) ? [Html::img(\Yii::getAlias('@web/uploads/foto/' . $model->data->nip . '/' . $model->dokumen), ['class' => 'col-xs-12'])] : [],
                    'maxFileSize' => 2048,
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'frameClass' => 'krajee-default row',
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
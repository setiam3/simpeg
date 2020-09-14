<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$role = \Yii::$app->tools->getcurrentroleuser();
if (in_array('karyawan', $role)) {
    $data = \app\models\MBiodata::findOne(['is_pegawai' => '1', 'id_data' => \Yii::$app->user->identity->id_data]);
    $parent = [$data->id_data => $data->nama];
} elseif (in_array('operator', $role) || in_array('admin', $role)) {
    !empty($klikedid) ? $parent = ArrayHelper::map(\app\models\MBiodata::findAll(['is_pegawai' => '1', 'id_data' => $klikedid]), 'id_data', 'nama') :
        $parent = ArrayHelper::map(\app\models\MBiodata::findAll(['is_pegawai' => '1']), 'id_data', 'nama');
} else {
    $parent = ArrayHelper::map(\app\models\MBiodata::findAll(['is_pegawai' => '1']), 'id_data', 'nama');
}

?>

<div class="riwayatjabatan-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
                'data' => $parent,
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Nama Pegawai')
            ?>

            <?= $form->field($model, 'id_jabatan')->widget(\kartik\select2\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\MReferensi::find()->where(['tipe_referensi' => '3'])->all(), 'reff_id', 'nama_referensi'),
                'language' => 'de',
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Jabatan');
            ?>

            <?= $form->field($model, 'eselon')->widget(\kartik\widgets\SwitchInput::classname(), ['pluginOptions' => [
                'handleWidth' => 60, 'onText' => 'Aktif', 'offText' => 'Tidak'
            ]]) ?>

            <?= $form->field($model, 'noSk')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tglSk')->widget(\kartik\date\DatePicker::classname(), [
                'options' => ['placeholder' => 'masukan tanggal'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>

            <?= $form->field($model, 'tmtJabatan')->widget(\kartik\date\DatePicker::classname(), [
                'options' => ['placeholder' => 'masukan tanggal'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'dokumen')->widget(\kartik\file\FileInput::classname(), [
                'options' => ['accept' => 'image/*', 'application/pdf', 'autoReplace' => true],
                'pluginOptions' => [
                    'initialPreview' => $model->isNewRecord ? [] : [Html::img(\Yii::getAlias('@web/uploads/foto/' . $model->data->nip . '/' . $model->dokumen), ['class' => 'col-xs-12'])],
                    'maxFileSize' => 2048,
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'browseClass' => 'btn btn-primary btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' =>  'Select File'
                ],
            ]) ?>

            <?= $form->field($model, 'unit_kerja')->widget(\kartik\select2\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\MUnit::find()->all(), 'id', 'unit'),
                'language' => 'de',
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('unitkerja');
            ?>
        </div>
    </div>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
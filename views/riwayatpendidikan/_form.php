<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Riwayatpendidikan */
/* @var $form yii\widgets\ActiveForm */

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

<div class="riwayatpendidikan-forms">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-sm-4">
        <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
            'data' => $parent,
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Nama Pegawai')
        ?>
        <?= $form->field($model, 'tingkatPendidikan')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\app\models\MReferensi::find()->where(['tipe_referensi' => '10', 'status' => '1'])->all(), 'reff_id', 'nama_referensi'),
            'options' => ['placeholder' => 'Select sekolah ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])
        ?>
        <?= $form->field($model, 'namaSekolah')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'jurusan')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'thMasuk')->widget(DatePicker::className(), [
            'pluginOptions' => [
                'format' => 'yyyy',
                'todayHighlight' => true,
                'autoclose' => true,
                'viewMode' => "years",
                'minViewMode' => "years"
            ]
        ])  ?>
        <?= $form->field($model, 'thLulus')->widget(DatePicker::className(), [
            'pluginOptions' => [
                'format' => 'yyyy',
                'todayHighlight' => true,
                'autoclose' => true,
                'viewMode' => "years",
                'minViewMode' => "years"
            ]
        ])  ?>
        <?= $form->field($model, 'no_ijazah')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'tgl_ijazah')->widget(DatePicker::className(), [
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                'autoclose' => true
            ]
        ]) ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'dokumen')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*', 'application/pdf', 'autoReplace' => true],
            'pluginOptions' => [
                'maxFileSize' => 2048,
                'initialPreview' => (!$model->isNewRecord && isset($model->dokumen)) ? [Html::img(\Yii::getAlias('@web/uploads/foto/' . $model->data->nip . '/' . $model->dokumen), ['class' => 'col-xs-12'])] : [],
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
                'frameClass' => 'krajee-default row',
                'browseClass' => 'btn btn-primary btn-block',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  'Select Foto'
            ],
        ]) ?>
    </div>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$role = \Yii::$app->tools->getcurrentroleuser();
if (in_array('karyawan', $role)) {
    $data = \app\models\MBiodata::findOne(['is_pegawai' => '1', 'id_data' => \Yii::$app->user->identity->id_data]);
    $parent = [$data->id_data => $data->namalengkap];
} elseif (in_array('operator', $role) || in_array('admin', $role)) {
    if (!empty($klikedid)) {
        $parent = ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai' => '1', 'id_data' => $klikedid])->all(), 'id_data', 'namaLengkap');
    } else {
        $parent = $model->isNewRecord ? ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai' => '1'])->andWhere(['not', ['jenis_pegawai' => '4']])->andWhere(['not', ['jenis_pegawai' => NULL]])->all(), 'id_data', 'namaLengkap') :
            ArrayHelper::map(\app\models\MBiodata::find()->where(['id_data' => $model->id_data])->all(), 'id_data', 'namaLengkap');
    }
}

?>

<div class="riwayatjabatan-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'id_data')->widget(\kartik\select2\Select2::classname(), [
                'data' => $parent,
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ])
            ?>

            <?= $form->field($model, 'id_jabatan')->widget(\kartik\select2\Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\MReferensi::find()->where(['tipe_referensi' => '3', 'status' => '1'])->all(), 'reff_id', 'nama_referensi'),
                'options' => ['placeholder' => 'Select ...'],

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
                    'initialPreview' => (!$model->isNewRecord && isset($model->dokumen)) ? [Html::img(\Yii::getAlias('@web/uploads/foto/' . $model->data->nip . '/' . $model->dokumen), ['class' => 'col-xs-12'])] : [],
                    'maxFileSize' => 2048,
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'frameClass' => 'krajee-default row',
                    'browseClass' => 'btn btn-primary btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' =>  'Select File'
                ],
            ]) ?>

            <?= $form->field($model, 'unit_kerja')->widget(\kartik\select2\Select2::classname(), [

                'data' => ArrayHelper::map(\app\models\MUnit::find()->all(), 'id', 'unit'),

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

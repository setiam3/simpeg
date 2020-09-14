<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\TransaksiPenggajian */
/* @var $form yii\widgets\ActiveForm */

$role = \Yii::$app->tools->getcurrentroleuser();
if (in_array('karyawan', $role)) {
    $data = \app\models\MBiodata::findOne(['is_pegawai' => '1', 'id_data' => \Yii::$app->user->identity->id_data]);
    $parent = [$data->id_data => $data->nama];
} else {
    $parent = ArrayHelper::map(\app\models\MBiodata::findAll(['is_pegawai' => '1']), 'id_data', 'nama');
}


?>
<div class="transaksi-penggajian-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($transaksipenggajian, 'data_id')->widget(\kartik\select2\Select2::classname(), [
                'data' => $parent,
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Nama');
            ?>
            <?= $form->field($transaksipenggajian, 'nomor_transgaji') ?>
            <?= $form->field($transaksipenggajian, 'tgl_gaji')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'masukan tanggal Mulai'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>
            <?= $form->field($transaksipenggajian, 'tgl_input')->widget(\kartik\date\DatePicker::className(), [
                'options' => ['value' => date("Y-m-d"), 'readonly' => true,],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'autoclose' => true
                ]
            ]); ?>
            <?= $form->field($transaksipenggajian, 'total_brutto_gaji') ?>
            <?= $form->field($transaksipenggajian, 'total_bersih_gaji') ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($transaksipenggajiandetail, 'gol_gaji')->widget(\kartik\select2\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Penggolongangaji::find()->all(), 'id', 'id'),
                'language' => 'de',
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Golongan Gaji');
            ?>
            <?= $form->field($transaksipenggajiandetail, 'tunjangan_id')->widget(\kartik\select2\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\MTunjangan::find()->all(), 'id', 'id'),
                'language' => 'de',
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Tunjangan Id');
            ?>
            <?= $form->field($transaksipenggajiandetail, 'nominal_val') ?>

            <?= $form->field($potongangaji, 'potongan_desc')->widget(\kartik\select2\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\MReferensi::find()->where(['tipe_referensi' => '13'])->all(), 'reff_id', 'nama_referensi'),
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Potongan Desc')
            ?>
            <?= $form->field($potongangaji, 'potongan_nominal') ?>
            <?= $form->field($potongangaji, 'keterangan')->textArea() ?>
        </div>

    </div>
    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($transaksipenggajian->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
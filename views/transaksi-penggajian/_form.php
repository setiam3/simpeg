<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;



$role = \Yii::$app->tools->getcurrentroleuser();
if (in_array('karyawan', $role)) {
    $data = \app\models\MBiodata::find()->select('id_data,concat("gelarDepan","nama","gelarBelakang") as nama')->where(['is_pegawai' => '1', 'id_data' => \Yii::$app->user->identity->id_data])->andWhere(['not', ['jenis_pegawai' => '4']])->andWhere(['not', ['jenis_pegawai' => NULL]])->one();
    $parent = [$data->id_data => $data->nama];

} elseif (in_array('operator', $role) || in_array('admin', $role)) {
    if (!empty($klikedid)) {
        $parent = ArrayHelper::map(\app\models\MBiodata::find()->select('id_data,concat("gelarDepan","nama","gelarBelakang") as nama')->where(['is_pegawai' => '1', 'id_data' => $klikedid])->all(), 'id_data', 'nama');
    } else {
        $parent = $transaksipenggajian->isNewRecord ? ArrayHelper::map(\app\models\MBiodata::find()->select('id_data,concat("gelarDepan","nama","gelarBelakang") as nama')->where(['is_pegawai' => '1'])->andWhere(['not', ['jenis_pegawai' => '4']])->andWhere(['not', ['jenis_pegawai' => NULL]])->all(), 'id_data', 'nama') :
            ArrayHelper::map(\app\models\MBiodata::find()->select('id_data,concat("gelarDepan","nama","gelarBelakang") as nama')->where(['id_data' => $model->id_data])->all(), 'id_data', 'nama');
    }
}

?>
<div class="transaksi-penggajian-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($transaksipenggajian, 'data_id')->widget(\kartik\select2\Select2::classname(), [
                'data' => $parent,
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ])
            ?>
            <?= $form->field($transaksipenggajian, 'nomor_transgaji') ?>
            <?= $form->field($transaksipenggajian, 'tgl_gaji')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'masukan tanggal'],
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
                'data' => \yii\helpers\ArrayHelper::map(
                    (new \yii\db\Query())
                        ->from('penggolongangaji')
                        ->rightJoin('m_referensi', 'penggolongangaji.pangkat_id = m_referensi.reff_id')
                        ->where('tipe_referensi = 6')
                        ->all(),
                    'id',
                    'nama_referensi'
                ),
                //                        \app\models\Penggolongangaji::find()
                //                    ->joinWith('pangkat',true,'RIGHT JOIN')
                //                    ->where(['tipe_referensi' => 6])
                //                    ->all(), 'pangkat_id', 'nama_referensi'),
                'language' => 'de',
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Golongan Gaji');
            ?>
            <?= $form->field($transaksipenggajiandetail, 'tunjangan_id')->widget(\kartik\select2\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\MTunjangan::find()->all(), 'id', 'tunjangan_id'),
                'language' => 'de',
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Tunjangan Id');
            ?>

            <?=
                Select2::widget([
                    'name' => 'Tunjangan_id',
                    'data' => \yii\helpers\ArrayHelper::map(\app\models\MTunjangan::find()->joinWith('tunjangan')->all(), 'id', 'tunjangan_id'),
                    'size' => Select2::MEDIUM,
                    'options' => ['placeholder' => 'Select  ...', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],

                ]);
            ?>


            <?= $form->field($transaksipenggajiandetail, 'nominal_val') ?>

            <?= $form->field($potongangaji, 'potongan_desc')->widget(\kartik\select2\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\MReferensi::find()->where(['tipe_referensi' => '13', 'status' => '1'])->all(), 'reff_id', 'nama_referensi'),
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
    <div class="row">
        <div class="col-md-12">
            <table>
                <tr>
                    <td>no</td>
                    <td>keterangan</td>
                    <td>jumlah</td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>gaji pokok</td>
                    <td>2000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>tunjangan1</td>
                    <td>2000</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>tunjangan2</td>
                    <td>2000</td>
                </tr>

                <tr>
                    <td>4</td>
                    <td>potongan 1</td>
                    <td>2000</td>
                </tr>

                <tr>
                    <td>5</td>
                    <td>potongan 2</td>
                    <td>2000</td>
                </tr>

                <tr>
                    <td></td>
                    <td>jumlah</td>
                    <td>2000</td>
                </tr>

            </table>
        </div>
    </div>
    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($transaksipenggajian->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

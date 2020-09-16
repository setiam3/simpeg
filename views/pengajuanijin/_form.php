<?php


use app\models\Jatahcuti;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Pengajuanijin */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsVar('baseurl',yii\helpers\Url::home());
$role = \Yii::$app->tools->getcurrentroleuser();
if (in_array('karyawan', $role)) {
    $data = \app\models\MBiodata::findOne(['is_pegawai' => '1', 'id_data' => \Yii::$app->user->identity->id_data]);
    $parent = [$data->id_data => $data->nama];
} else {
    $parent = ArrayHelper::map(\app\models\MBiodata::findAll(['is_pegawai' => '1']), 'id_data', 'nama');
}

?>

<div class="pengajuanijin-form">

    <?php $form = ActiveForm::begin(); ?>


<div><p id="sisaijin">Sisa Ijin: </p></div>


    <?= $form->field($model, 'id_data')->widget(\kartik\select2\Select2::classname(), [
        'data' => $parent,
        'pluginOptions' => [
            'allowClear' => false,

        ],
        'pluginEvents' => [
            "change" => "function() {
            $.get(
                baseurl+'site/sisaijin',
                {id: $('#pengajuanijin-id_data').val()},
                function (data) {
                    console.log(data);
                    $('#sisaijin').html(data);
                }
            );
            return false;
            
             }",
        ],


    ])->label('Nama Pegawai');
    ?>

    <?= $form->field($model, 'tanggalMulai')->widget(\kartik\date\DatePicker::className(), [
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'tanggalAkhir')->widget(\kartik\date\DatePicker::className(), [
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'alasan')->textArea() ?>


    <?= $form->field($model, 'jenisIjin')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MReferensi::find()->where(['tipe_referensi' => '12','status'=>'1'])->all(), 'nama_referensi', 'nama_referensi'),
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Jenis ijin'); ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

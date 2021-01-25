<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
$role=\Yii::$app->tools->getcurrentroleuser();
if(in_array('karyawan',$role)){
    $data=\app\models\MBiodata::find()->where(['is_pegawai'=>'1','id_data'=>\Yii::$app->user->identity->id_data])->andWhere(['not',['jenis_pegawai'=>'4']])->andWhere(['not',['jenis_pegawai'=>NULL]])->one();
    $parent=[$data->id_data => $data->namalengkap];
}else{
    $parent=ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai'=>'1'])->andWhere(['not',['jenis_pegawai'=>'4']])->andWhere(['not',['jenis_pegawai'=>NULL]])->all(), 'id_data','namalengkap');
}
?>
<div class="mpinjaman-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
        'data' => $parent,
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions' => [
            'allowClear' => false
        ],
    ])
    ?>
    <?= $form->field($model, 'jenis')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\MReferensi::find()->where(['tipe_referensi' => '11','status'=>'1'])->all(), 'reff_id', 'nama_referensi'),// reff id = nama referensi
        'options' => ['placeholder' => 'Select Jenis ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Jenis Pinjaman')
    ?>
    <?= $form->field($model, 'namaBarang')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'masukan tanggal'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>
    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => true,'type'=>'number']) ?>
    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>
    <?php ActiveForm::end(); ?>
</div>

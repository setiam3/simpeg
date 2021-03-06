<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
$role=\Yii::$app->tools->getcurrentroleuser();
if(in_array('karyawan',$role)){
    $data=\app\models\MBiodata::find()->where(['is_pegawai'=>'1','id_data'=>\Yii::$app->user->identity->id_data])->andWhere(['not',['jenis_pegawai'=>'4']])->andWhere(['not',['jenis_pegawai'=>NULL]])->one();
    $parent=[$data->id_data => $data->namalengkap];
}elseif(in_array('operator',$role) || in_array('admin',$role)){
    !empty($klikedid)?$parent=ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai'=>'1','id_data'=>$klikedid])->andWhere(['not',['jenis_pegawai'=>'4']])->andWhere(['not',['jenis_pegawai'=>NULL]])->all(), 'id_data','namalengkap'):
    $parent=ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai'=>'1'])->andWhere(['not',['jenis_pegawai'=>'4']])->andWhere(['not',['jenis_pegawai'=>NULL]])->all(),'id_data','namalengkap');
}else{
    $parent=ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai'=>'1'])->andWhere(['not',['jenis_pegawai'=>'4']])->andWhere(['not',['jenis_pegawai'=>NULL]])->all(),'id_data','namalengkap');
}
?>
<div class="mkepangkatan-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
                'data' =>$parent,
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => ['allowClear' => true],
            ])->label('Nama');
            ?>
            <?= $form->field($model, 'ditetapkanOleh')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'noSk')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'tglSk')->widget(DatePicker::className(),[
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'autoclose'=>true
                ]
            ])?>
            <?= $form->field($model, 'penggolongangaji_id')->widget(Select2::classname(), [
                'data' =>
                    \yii\helpers\ArrayHelper::map(\app\models\Penggolongangaji::find()
                    ->leftJoin('m_referensi','m_referensi.reff_id = penggolongangaji.pangkat_id')
                    ->where(['m_referensi.tipe_referensi'=>6,'status'=>'1'])
                        ->all(),'id','pangkat.nama_referensi'),
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => ['allowClear' => true],
            ])->label('penggolongan gaji');
            ?>
            <?= $form->field($model, 'tmtPangkat')->widget(DatePicker::className(),[
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd','todayHighlight' => true,'autoclose'=>true
                ]
            ])?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tmt')->widget(DatePicker::className(),[
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd','todayHighlight' => true,'autoclose'=>true
                ]
            ]) ?>

            <?= $form->field($model, 'dokumen')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*', 'application/pdf', 'autoReplace' => true],
                'pluginOptions' => [
                    'initialPreview' => (!$model->isNewRecord && isset($model->dokumen)) ?[Html::img(\Yii::getAlias('@web/uploads/foto/' . $model->data->nip . '/' . $model->dokumen), ['class' => 'col-xs-12'])]:[],
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
        </div>
    </div>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>
    <?php ActiveForm::end(); ?>
</div>

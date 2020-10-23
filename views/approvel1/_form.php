<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="pengajuanijin-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'id_data')->widget(\kartik\select2\Select2::classname(), [
            'disabled'=>'readonly',
            'data' => \yii\helpers\ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai'=> '1'])->all(),'id_data','namalengkap'),
            'language' => 'de',
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ])->label('Nama');?>
            <?= $form->field($model, 'jenisIjin')->textInput(['maxlength' => true,'readonly' => true,]) ?>
            <?= $form->field($model, 'tanggalPengajuan')->textInput(['readonly' => true,]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'tanggalMulai')->textInput(['readonly' => true,]) ?>
            <?= $form->field($model, 'tanggalAkhir')->textInput(['readonly' => true,]) ?>
            <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'alasan')->textArea(['readonly' => true,]) ?>

            <?= $form->field($model, 'approval1')->widget(\kartik\widgets\SwitchInput::classname(),['pluginOptions'=>[
                'handleWidth'=>60,'onText'=>'Setujui','offText'=>'Tidak'
            ]
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

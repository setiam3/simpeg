<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\SwitchInput;
?>

<div class="mpenggolongan-gaji-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pangkat_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MReferensi::findAll(['tipe_referensi'=>'6','status'=>'1']),'reff_id','nama_referensi'),
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Pangkat'); ?>

    <?= $form->field($model, 'masa_kerja')->textInput() ?>

    <?= $form->field($model, 'gaji')->widget(\yii\widgets\MaskedInput::className(), [
       'clientOptions' => [
            'alias' => 'numeric',
            // 'digits' => 2,
            'digitsOptional' => true,
            'radixPoint' => '.',
            'groupSeparator' => ',',
            'autoGroup' => true,
            'removeMaskOnSubmit' => true,
        ],
    ])?>

    <?= $form->field($model, 'status_penggolongan')->widget(SwitchInput::classname(),['pluginOptions'=>[
        'handleWidth'=>60,'onText'=>'Aktif','offText'=>'Tidak'
    ]
    ]) ?>

    <?= $form->field($model, 'jenis_pegawai')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MReferensi::findAll(['tipe_referensi'=>'1','status'=>'1']),'reff_id','nama_referensi'),
        'language' => 'de',
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Jenis Pegawai'); ?>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>

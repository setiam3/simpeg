<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\SwitchInput;
use yii\bootstrap\Modal;
?>

<div class="mpenggolongan-gaji-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pangkat_id',['template' => '
   {label}
   <div class="row">
   <div class="col-sm-12">
       <div class="input-group col-sm-11">
          {input}
          <span class="input-group-btn">
        '.Html::a(
                    '<i class="glyphicon glyphicon-plus"></i>',
                    ['/referensi/create'],
                    ['role' => 'modal-remote', 'data-target' => '#'.md5(\app\models\MReferensi::className()), 'title' => 'Tambah Referensi', 'class' => 'btn btn-default']
                ).'
      </span>
       </div>
       </div>
       {error}{hint}
   </div>'])->widget(Select2::classname(), [
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
        'language' => 'en',
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Jenis Pegawai'); ?>
    <?= $form->field($model, 'tingkatpendidikan')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MReferensi::findAll(['tipe_referensi'=>'10','status'=>'1']),'reff_id','nama_referensi'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Pendidikan'); ?>
    <?= $form->field($model, 'keterangan')->textInput() ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>

<?php Modal::begin([
    "id" => md5(\app\models\MReferensi::className()),
    "footer" => "",
    'class'=>'modalref'
]) ?>
<?php Modal::end(); ?>
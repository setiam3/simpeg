<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\number\NumberControl;
use kartik\widgets\SwitchInput;
/* @var $this yii\web\View */
/* @var $model app\models\MTunjangan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mtunjangan-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'tunjangan_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MReferensi::findAll(['tipe_referensi'=>'4','status'=>'1']),'reff_id','nama_referensi'),
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions' => ['allowClear' => false],
    ])->label('Jenis Tunjangan');
    ?>
    <?= $form->field($model, 'nominal')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(),['pluginOptions'=>[
                'handleWidth'=>60,'onText'=>'Aktif','offText'=>'Non Aktif'
            ]
        ]) ?>

    <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai'=>'1'])->andWhere(['not',['jenis_pegawai'=>'4']])->andWhere(['not',['jenis_pegawai'=>NULL]])->all(),'id_data','nama'),
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Nama Pegawai');
    ?>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>

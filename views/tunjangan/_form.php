<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model app\models\MTunjangan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mtunjangan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tunjangan_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MReferensi::findAll(['tipe_referensi'=>'4']),'reff_id','nama_referensi'),
        'language' => 'de',
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Tunjangan');
    ?>
    <?= $form->field($model, 'nominal')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai'=>'1'])->all(),'id_data','nama'),
        'language' => 'de',
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Nama');
    ?>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>

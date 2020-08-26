<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MBiodata */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mbiodata-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_data')->textInput() ?>

    <?= $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempatLahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggalLahir')->textInput() ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kabupatenKota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kecamatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kelurahan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenisKelamin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statusPerkawinan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gelarDepan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gelarBelakang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fotoNik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'golonganDarah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_hubungan_keluarga')->textInput() ?>

    <?= $form->field($model, 'is_pegawai')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

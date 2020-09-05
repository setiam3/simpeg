<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pengajuanijin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengajuanijin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tanggalPengajuan')->textInput() ?>

    <?= $form->field($model, 'tanggalMulai')->textInput() ?>

    <?= $form->field($model, 'tanggalAkhir')->textInput() ?>

    <?= $form->field($model, 'alasan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_data')->textInput() ?>

    <?= $form->field($model, 'approval1')->textInput() ?>

    <?= $form->field($model, 'approval2')->textInput() ?>

    <?= $form->field($model, 'disetujui')->textInput() ?>

    <?= $form->field($model, 'jenisIjin')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

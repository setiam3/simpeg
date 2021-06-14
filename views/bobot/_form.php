<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MsBobot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ms-bobot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <?= $form->field($model, 'uraian')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bobot')->textInput() ?>

    <?= $form->field($model, 'nilai_rasio')->textInput() ?>

    <?= $form->field($model, 'kategory')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

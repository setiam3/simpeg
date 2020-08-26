<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\SwitchInput;
?>

<div class="mreferensi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_referensi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipe_referensi')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\MReffTipe::findAll(['status'=>'1']), 'tipereff_id','nama_reff_tipe'),
        'options' => ['placeholder' => 'Select Tipe ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])?>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(),['pluginOptions'=>[
                'handleWidth'=>60,'onText'=>'Active','offText'=>'Inactive'
            ]
        ]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

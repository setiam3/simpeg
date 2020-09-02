<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
/* @var $this yii\web\View */
/* @var $model app\models\MUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="munit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_instalasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_vip')->widget(SwitchInput::classname(),['pluginOptions'=>[
                'handleWidth'=>60,'onText'=>'Ya','offText'=>'Tidak'
            ]
        ]) ?>

    <?= $form->field($model, 'aktif')->widget(SwitchInput::classname(),['pluginOptions'=>[
                'handleWidth'=>60,'onText'=>'Ya','offText'=>'Tidak'
            ]
        ]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

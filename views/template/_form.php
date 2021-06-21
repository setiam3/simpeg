<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MsTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ms-template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'indikator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bobot')->textInput() ?>

    <?= $form->field($model, 'target')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent')->textInput() ?>
    
    <?= $form->field($model, 'idunit')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MUnit::find()->where(['aktif' => '1'])->all(),'id','unit'),
        'pluginOptions' => [
            'allowClear' => false
        ],
        'options' => ['placeholder' => 'Select a pekerjaan ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>

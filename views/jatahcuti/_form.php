<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="jatahcuti-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_data')->textInput() ?>

    <?= $form->field($model, 'sisa')->textInput() ?>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>

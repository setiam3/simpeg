<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
?>
<div class="jatahcuti-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_data')->widget(Select2::className(),[
		'data' => ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai' => '1'])->all(),'id_data','namalengkap'),
                'pluginOptions' => [
                    'allowClear' => false
                ],
	]) ?>

    <?= $form->field($model, 'sisa')->textInput(['type'=>'number']) ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>

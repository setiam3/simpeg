<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\bootstrap\Dropdown;
//$typeicons='fa fa-';
$typeicons='glyphicon';
$format = <<< SCRIPT
function format(state) {
    if (!state.id) return "$typeicons "+state.text; // optgroup
    return '<span class="'+state.text+'" aria-hidden="true"></span> ' + state.text;
}
SCRIPT;
$escape = new JsExpression("function(m) { return m; }");
$this->registerJs($format, $this::POS_HEAD);

?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent')->textInput() ?>

    <?= $form->field($model, 'route')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'icon')->widget(Select2::className(),[
    'data' => ArrayHelper::map(Yii::$app->tools->listIcon($typeicons),'value','value'),
    'options' => ['placeholder' => 'Select a icon ...'],
    'pluginOptions' => [
        'templateResult' => new JsExpression('format'),
        'templateSelection' => new JsExpression('format'),
        'escapeMarkup' => $escape,
        'allowClear' => true
    ],
]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

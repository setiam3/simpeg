<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="pengajuanijin-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= Html::hiddenInput('selection',$selection);?>
    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true,'name'=>'keterangan']) ?>

    <?= $form->field($model, 'approval1')->widget(\kartik\widgets\SwitchInput::classname(),['pluginOptions'=>[
        'handleWidth'=>60,'onText'=>'Setujuhi','offText'=>'Tidak'
    ]
    ]) ?>


    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

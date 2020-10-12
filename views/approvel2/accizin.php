<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="pengajuanijin-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= Html::hiddenInput('selection', $selection); ?>

    <?= $form->field($model, 'approval2')->widget(\kartik\widgets\SwitchInput::classname(), ['pluginOptions' => [
        'handleWidth' => 60, 'onText' => 'Setujui', 'offText' => 'Tidak'
    ]]) ?>
    <?= $form->field($model, 'keterangan')->textarea(['name'=>'keterangan']) ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use yii\web\JsExpression;
$format = <<< SCRIPT
function concate(data) {
    if (!data.id) return data.text;
    return data.text;
}
SCRIPT;
$escape = new JsExpression("function(m) { return m; }");
$this->registerJs($format, $this::POS_HEAD);
?>
<div class="mrekening-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
                'data' =>ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai'=>'1'])->andWhere(['not',['jenis_pegawai'=>'4']])->andWhere(['not',['jenis_pegawai'=>NULL]])->all(),'id_data','namalengkap'),
                'options' => ['placeholder' => 'Select ...'],
                'pluginOptions' => [
                    'templateResult' => new JsExpression('concate'),
                    'templateSelection' => new JsExpression('concate'),
                    'escapeMarkup' => $escape,
                    'allowClear' => true
                ],
            ])->label('Nama Pegawai')
            ?>
            <?= $form->field($model, 'bank_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\MReferensi::find()->where(['tipe_referensi' => '5','status'=>'1'])->all(), 'reff_id', 'nama_referensi'),
                'options' => ['placeholder' => 'Select bank id ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Bank')
            ?>
            <?= $form->field($model, 'nomor_rekening')->textInput(['maxlength' => true, 'type' => 'number']) ?>
            <?= $form->field($model, 'npwp')->textInput(['maxlength' => true, 'type' => 'number']) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'fotoNpwp')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*', 'application/pdf', 'autoReplace' => true],
                'pluginOptions' => [
                    'initialPreview' => (!$model->isNewRecord && isset($model->fotoNpwp)) ?[Html::img(\Yii::getAlias('@web/uploads/foto/' . $model->data->nip . '/' . $model->fotoNpwp), ['class' => 'col-xs-12'])]:[],
                    'maxFileSize' => 2048,
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'frameClass' => 'krajee-default row',
                    'browseClass' => 'btn btn-primary btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' =>  'Select Foto'
                ],
            ]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'fotoRekening')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*', 'application/pdf', 'autoReplace' => true],
                'pluginOptions' => [
                    'initialPreview' => (!$model->isNewRecord && isset($model->fotoRekening)) ?[Html::img(\Yii::getAlias('@web/uploads/foto/' . $model->data->nip . '/' . $model->fotoRekening), ['class' => 'col-xs-12'])]:[],
                    'showPreview' => true,
                    'maxFileSize' => 2048,
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'frameClass' => 'krajee-default row',
                    'browseClass' => 'btn btn-primary btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' =>  'Select Foto'
                ],
            ]) ?>
        </div>
    </div>
    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>
    <?php ActiveForm::end(); ?>
</div>

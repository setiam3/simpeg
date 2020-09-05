<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\MKepangkatan */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="mkepangkatan-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\MBiodata::find()->all(),'id_data','nama'),
                'language' => 'de',
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Nama');
            ?>

            <?= $form->field($model, 'ditetapkanOleh')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'noSk')->textInput(['maxlength' => true]) ?>


            <?= $form->field($model, 'tglSk')->widget(DatePicker::className(),[
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'autoclose'=>true
                ]
            ])?>

            <?= $form->field($model, 'penggolongangaji_id')->widget(Select2::classname(), [
                'data' =>
                    \yii\helpers\ArrayHelper::map(\app\models\MPenggolongangaji::find()
                    ->leftJoin('m_referensi','m_referensi.reff_id = penggolongangaji.pangkat_id')
    ->where(['m_referensi.tipe_referensi'=>6])
                        ->all(),'id','pangkat.nama_referensi'),
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('penggolongan gaji');
            ?>

            <?= $form->field($model, 'tmtPangkat')->widget(DatePicker::className(),[
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'autoclose'=>true
                ]
            ])?>


        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'tmt')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'dokumen')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*', 'application/pdf', 'autoReplace' => true],
                'pluginOptions' => [
                    'initialPreview' => $model->isNewRecord ? [] : [Html::img(\Yii::getAlias('@web/uploads/foto/' . $model->data->nip . '/' . $model->dokumen), ['class' => 'col-xs-12'])],
                    'maxFileSize' => 2048,
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'browseClass' => 'btn btn-primary btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' =>  'Select File'
                ],
            ]) ?>
        </div>
    </div>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>

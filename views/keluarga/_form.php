<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\date\DatePicker;
?>

<div class="mbiodata-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    <div class="col-xs-6">
    <?= $form->field($model, 'parent_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\MBiodata::findAll(['is_pegawai'=>1]), 'id_data','nama'),
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempatLahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggalLahir')->widget(DatePicker::className(),[
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'autoclose'=>true
                ]
            ])?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kabupatenKota')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\Kabupaten::findAll(['province_id'=>'35']), 'id','name'),
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>

        <?= $form->field($model, 'kecamatan')->widget(DepDrop::classname(),[
                'data'=>!$model->isNewRecord && isset($model->kecamatan)?[$model->kecamatan=>\app\models\Kecamatan::findOne(['id'=>$model->kecamatan])->name]:[],
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['placeholder' => 'Select ...'],
                'select2Options' => [
                    'options'=>['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear' => true]
                ],
                'pluginOptions'=>[
                    'depends'=>['mbiodata-kabupatenkota'],
                    'placeholder' => 'Select...',
                    'url' => Url::to(['/site/child?model=Kecamatan']),
                    'loadingText' => 'Loading kecamatan ...',
                ]
            ]) ?>
        <?= $form->field($model, 'kelurahan')->widget(DepDrop::classname(),[
                'data'=>!$model->isNewRecord && isset($model->kelurahan)?[$model->kelurahan=>\app\models\Kelurahan::findOne(['id'=>$model->kelurahan])->name]:[],
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['placeholder' => 'Select ...'],
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions'=>[
                    'depends'=>['mbiodata-kecamatan'],
                    'placeholder' => 'Select...',
                    'url' => Url::to(['/site/child?model=Kelurahan']),
                    'loadingText' => 'Loading kelurahan ...',
                ]
            ]) ?>  

<?= $form->field($model, 'jenisKelamin')->radioList(
            ArrayHelper::map(\app\models\MReferensi::findAll(['tipe_referensi'=>'8']), 'reff_id','nama_referensi')
        ) ?>

    <?= $form->field($model, 'agama')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\MReferensi::findAll(['tipe_referensi'=>'7']), 'reff_id','nama_referensi'),
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])?>

    <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statusPerkawinan')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\MReferensi::findAll(['tipe_referensi'=>'9']), 'reff_id','nama_referensi'),
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
    </div>
    <div class="col-xs-6">
    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'foto')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*','autoReplace'=>true],
        'pluginOptions' => [
            'initialPreview'=>[
                Html::img(\Yii::getAlias('@web/uploads/foto/'.$model->parent->nip.'/'.$model->foto),['class'=>'col-xs-12'])
            ],
            'maxFileSize' => 2048,
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' =>  'Select Foto'
            ],
        ]) ?>
<?= $form->field($model, 'fotoNik')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*','autoReplace'=>true],
        'pluginOptions' => [
            'initialPreview'=>[
                Html::img(\Yii::getAlias('@web/uploads/foto/'.$model->parent->nip.'/'.$model->fotoNik),['class'=>'col-xs-12'])
            ],
            'maxFileSize' => 2048,
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' =>  'Select Foto'
            ],
        ]) ?>

    <?= $form->field($model, 'golonganDarah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_hubungan_keluarga')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\MReferensi::findAll(['tipe_referensi'=>2]), 'reff_id','nama_referensi'),
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>
    
</div>

<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\widgets\SwitchInput;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\file\FileInput;

?>
<div class="pegawai-create">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-3">
            <?php 
            if(!empty($mbiodata->foto) && file_exists(Yii::getAlias('@uploads').$mbiodata->foto)){
                echo Html::img(Yii::getAlias('@web').'/uploads/foto/'.$mbiodata->foto,['class'=>'col-xs-12']);
            }
            ?>
                <?= $form->field($mbiodata, 'foto')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'maxFileSize' => 2048,
                        'showPreview' => $mpegawai->isNewRecord,
                        'showCaption' => false,
                        'showRemove' => false,
                        'showUpload' => false,
                        'browseClass' => 'btn btn-primary btn-block',
                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                        'browseLabel' =>  'Select Foto'
                    ],
                ]) ?>
        </div>
    <div class="col-md-3">
        <?= $form->field($mpegawai, 'nip')->textInput(['maxlength'=>true]) ?>
            <?= $form->field($mbiodata, 'nama')->textInput(['maxlength'=>true]) ?>
            <?= $form->field($mbiodata, 'gelarDepan')->textInput(['maxlength'=>true]) ?>
            <?= $form->field($mbiodata, 'gelarBelakang')->textInput(['maxlength'=>true]) ?>
            <?= $form->field($mbiodata, 'tempatLahir')->textInput(['maxlength'=>true]) ?>
            <?= $form->field($mbiodata, 'tanggalLahir')->widget(DatePicker::className(),[
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]) ?>
            <?= $form->field($mbiodata, 'golonganDarah')->textInput(['maxlength'=>true]) ?>
    </div>
        
        <div class="col-md-3">
            <?= $form->field($mbiodata, 'jenisKelamin')->radioList(ArrayHelper::map(Yii::$app->params['jenisKelamin'],'key','value')) ?>
            <?= $form->field($mbiodata, 'alamat') ?>
            <?= $form->field($mbiodata, 'kabupatenKota')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\Kabupaten::findAll(['province_id'=>'35']), 'id','name'),
                'options' => ['placeholder' => 'Select Kabupaten ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
            <?= $form->field($mbiodata, 'kecamatan')->widget(DepDrop::classname(),[
                'data'=>!$mbiodata->isNewRecord && isset($mbiodata->kecamatan)?[$mbiodata->kecamatan=>\app\models\Kecamatan::findOne(['id'=>$mbiodata->kecamatan])->name]:[],
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
            <?= $form->field($mbiodata, 'kelurahan')->widget(DepDrop::classname(),[
                'data'=>!$mbiodata->isNewRecord && isset($mbiodata->kelurahan)?[$mbiodata->kelurahan=>\app\models\Kelurahan::findOne(['id'=>$mbiodata->kelurahan])->name]:[],
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
            <?= $form->field($mbiodata, 'nik')->textInput(['maxlength'=>true]) ?>
            <?= $form->field($mbiodata, 'fotoNik')->fileInput(['accept'=>'image/*','maxFileSize' => 2048]) ?>
    </div>
    <div class="col-md-3">
        
        <?= $form->field($mpegawai, 'statusPegawai')
        ->dropDownList(ArrayHelper::map(Yii::$app->params['statusPegawai'],'key','value')) ?>
        <?= $form->field($mbiodata, 'agama')
        ->dropDownList(ArrayHelper::map(Yii::$app->params['agama'],'key','value')) ?>
        
        <?= $form->field($mbiodata, 'telp')->textInput(['maxlength'=>true]) ?>
        <?= $form->field($mbiodata, 'email')->textInput(['maxlength'=>true]) ?>
        <?= $form->field($mbiodata, 'statusPerkawinan')
        ->dropDownList(ArrayHelper::map(Yii::$app->params['statusPerkawinan'],'key','value')) ?>
        <?= $form->field($mpegawai, 'status')->widget(SwitchInput::classname(),['pluginOptions'=>[
                'handleWidth'=>60,'onText'=>'Active','offText'=>'Inactive'
            ]
        ]) ?>
    </div>

        <div class="form-group pull-right">
            <?= Html::submitButton($mpegawai->isNewRecord? 'Create' : 'Save', ['class' => 'btn btn-primary']) ?>
        </div>
        
    <?php ActiveForm::end(); ?>
</div><!-- pegawai-create -->

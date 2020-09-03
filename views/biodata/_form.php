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

<div class="mbiodata-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-xs-3">
        
        <?= $form->field($model, 'foto')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*','autoReplace'=>true],
        'pluginOptions' => [
            'initialPreview' => $model->isNewRecord?[]:[Html::img(\Yii::getAlias('@web/uploads/foto/' . $model->nip . '/' . $model->foto), ['class' => 'col-xs-12'])],
            'maxFileSize' => 2048,
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' =>  'Select Foto'
            ],
        ]) ?>
        <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'jenisKelamin')->radioList(
            ArrayHelper::map(\app\models\MReferensi::findAll(['tipe_referensi'=>'8']), 'reff_id','nama_referensi')
        ) ?>

        </div>
        <div class="col-xs-3">
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
            <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>  
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'agama')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\MReferensi::findAll(['tipe_referensi'=>'7']), 'reff_id','nama_referensi'),
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])?>

        <?= $form->field($model, 'statusPerkawinan')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\MReferensi::findAll(['tipe_referensi'=>'9']), 'reff_id','nama_referensi'),
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>

        <?= $form->field($model, 'gelarDepan')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'gelarBelakang')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'golonganDarah')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'is_pegawai')->widget(SwitchInput::classname(),['pluginOptions'=>[
                'handleWidth'=>60,'onText'=>'Ya','offText'=>'Tidak'
            ]
        ]) ?>

        <?= $form->field($model, 'checklog_id')->textInput() ?>
        </div>
        <div class="col-xs-3">
        <?= $form->field($model, 'fotoNik')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*','autoReplace'=>true],
        'pluginOptions' => [
            'initialPreview' => $model->isNewRecord?[]:[Html::img(\Yii::getAlias('@web/uploads/foto/' . $model->nip . '/' . $model->fotoNik), ['class' => 'col-xs-12'])],
            'maxFileSize' => 2048,
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' =>  'Select FotoNik'
            ],
        ]) ?>
        
        <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

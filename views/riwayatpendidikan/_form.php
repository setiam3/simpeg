<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Riwayatpendidikan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="riwayatpendidikan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_data')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai'=>1])->all(), 'id_data', 'nama'),
        'options' => ['placeholder' => 'Select id_data ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Nama Pegawai')
    ?>
    <?= $form->field($model, 'tingkatPendidikan')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\MReferensi::find()->where(['tipe_referensi'=>10])->all(), 'reff_id', 'nama_referensi'),
        'options' => ['placeholder' => 'Select sekolah ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>
    <?= $form->field($model, 'namaSekolah')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'jurusan')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'thMasuk')->widget(DatePicker::className(),[
        'pluginOptions' => [
            'format' => 'yyyy',
            'todayHighlight' => true,
            'autoclose'=>true,
            'viewMode' => "years", 
            'minViewMode' => "years"
        ]
    ])  ?>
    <?= $form->field($model, 'thLulus')->widget(DatePicker::className(),[
                'pluginOptions' => [
                    'format' => 'yyyy',
                    'todayHighlight' => true,
                    'autoclose'=>true,
                    'viewMode' => "years", 
                    'minViewMode' => "years"
                ]
            ])  ?>
    <?php
        if(!$model->isNewRecord) {
            $linkdokumen=\Yii::getAlias('@web/uploads/foto/'.$model->data->nip.'/'.$model->dokumen);
            if(file_exists(\Yii::getAlias('@uploads').$model->data->nip.'/'.$model->dokumen) && !empty($model->dokumen)){
                    echo Html::a(Html::img($linkdokumen,['class'=>'col-xs-12']),$linkdokumen);
            }
        }
    ?>
    <?= $form->field($model, 'no_ijazah')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tgl_ijazah')->widget(DatePicker::className(),[
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'autoclose'=>true
                ]
            ]) ?>
    <?= $form->field($model, 'dokumen')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*','application/pdf'],
        'pluginOptions' => [
            'maxFileSize' => 2048,
            'showPreview' => $model->isNewRecord,
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' =>  'Select Foto'
            ],
        ]) ?>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

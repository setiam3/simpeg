<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Paktaintegritas */
/* @var $form yii\widgets\ActiveForm */

$this->registerJSFile('@web/css/signature/signature_pad.min.js');
$this->registerJsVar('val_ttd', $model->ttd);
$this->registerCSS('
.wrapper{
    background:#fff !important;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
  .signature-pad {
    width:400px;
    height:200px;
    border : 1px solid;
  }
');

$script = <<< JS

    var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
          backgroundColor: 'rgba(255, 255, 255, 0)',
          penColor: 'rgb(0, 0, 0)'
        });
        var saveButton = document.getElementById('save');
        var cancelButton = document.getElementById('clear');
        var ttd = document.getElementById('paktaintegritas-ttd');
        saveButton.addEventListener('click', function (e) {
            e.preventDefault();
            var data = signaturePad.toDataURL('image/png');
            ttd.value=data;
            var preview = $("#preview_img");
            preview.attr("src", data);
            
            $('#myModal').modal('hide');
           
        });
        cancelButton.addEventListener('click', function (e) {
            e.preventDefault();
            signaturePad.clear();
            ttd.value='';
            return false;
        });
        if (val_ttd != null){
            var preview = $("#preview_img");
            preview.attr("src", val_ttd);
            
        }
JS;
$this->registerJs($script);
?>

<div class="paktaintegritas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomer')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'id_data')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(
            \app\models\MBiodata::find()->where(['is_pegawai' => '1'])->all(),
            'id_data',
            'namalengkap'
        ),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a nama ...'],
        'pluginOptions' => ['allowClear' => true, 'tags' => true,],
    ])->label('Nama'); ?>

    <?php echo '<label class="control-label">Jabatan Dalam Tim</label>';
    echo \kartik\select2\Select2::widget([
        'model'=>$model,
        'attribute' => 'jabatan',
        'name' => 'jabatan',
        'data' => [
            'Pelindung' => 'Pelindung',
            'Penanggung Jawab' => 'Penanggung Jawab',
            'Ketua' => 'Ketua',
            'Wakil Ketua' => 'Wakil Ketua',
            'Sekretaris' => 'Sekretaris',
            'Wakil Sekretaris' => 'Wakil Sekretaris',
            'Perwakilan Manajemen' => 'Perwakilan Manajemen',
            'Perwakilan Komite Medik' => 'Perwakilan Komite Medik',
            'Perwakilan Komite Keperawatan' => 'Perwakilan Komite Keperawatan',
            'Perwakilan Komite Profesi Lain' => 'Perwakilan Komite Profesi Lain',
            'Perwakilan Non Tenaga Kesehatan PNS' => 'Perwakilan Non Tenaga Kesehatan PNS',
            'Perwakilan Non Tenaga Kesehatan Non PNS BLUD' => 'Perwakilan Non Tenaga Kesehatan Non PNS BLUD',
        ],
        'options' => [
            'placeholder' => 'Select Jabatan',
        ],
    ]);
    ?>

    <?php echo '<div class="form-group">';
    echo '<label>Tanggal</label>';
    echo \kartik\date\DatePicker::widget([
        'name' => 'tanggal',
        'value' => date('Y-m-d'),
        'options' => ['placeholder' => 'Select issue date ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose'=>true,

        ]
    ]);
    echo '</div>'; ?>

    <?= $form->field($model, 'ttd')->hiddenInput(['maxlength' => true])->label(false) ?>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-1">
                <button type="button" class="btn btn-success bmodel" data-id="">
                    <i class="fa fa-plus"></i> TTD
                </button>
            </div>
            <div class="col-sm-11">
                <img id="preview_img" src="" style="height: 70px; "/>
            </div>
        </div>


    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div class="modal fade" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tanda Tangan</h4>
            </div>
            <form enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row-fluid">
                        <?php $form = ActiveForm::begin(['id' => 'form']); ?>
                        <div class="form-group">
                            <div class="wrapper" style="width:400px">
                                <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                            </div>
                            <button id="clear" class="btn btn-danger">Hapus TTD</button>
                            <button id="save" class="btn btn-info">Terapkan</button>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<?php
$script = <<< JS
$(".bmodel").click(function () {
    $('#myModal').modal('show');
});

JS;
$this->registerJs($script);

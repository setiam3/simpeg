<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\bootstrap\Tabs;

$role = \Yii::$app->tools->getcurrentroleuser();
if (in_array('karyawan', $role)) {
    $data = \app\models\MBiodata::find()->select('id_data,concat("gelarDepan","nama","gelarBelakang") as nama')->where(['is_pegawai' => '1', 'id_data' => \Yii::$app->user->identity->id_data])->andWhere(['not', ['jenis_pegawai' => '4']])->andWhere(['not', ['jenis_pegawai' => NULL]])->one();
    $parent = [$data->id_data => $data->nama];

} elseif (in_array('operator', $role) || in_array('admin', $role)) {
    if (!empty($klikedid)) {
        $parent = ArrayHelper::map(\app\models\MBiodata::find()->select('id_data,concat("gelarDepan","nama","gelarBelakang") as nama')->where(['is_pegawai' => '1', 'id_data' => $klikedid])->all(), 'id_data', 'nama');
    } else {
        $parent = $transaksipenggajian->isNewRecord ? ArrayHelper::map(\app\models\MBiodata::find()->select('id_data,concat("gelarDepan","nama","gelarBelakang") as nama')->where(['is_pegawai' => '1'])->andWhere(['not', ['jenis_pegawai' => '4']])->andWhere(['not', ['jenis_pegawai' => NULL]])->all(), 'id_data', 'nama') :
        ArrayHelper::map(\app\models\MBiodata::find()->select('id_data,concat("gelarDepan","nama","gelarBelakang") as nama')->where(['id_data' => $model->id_data])->all(), 'id_data', 'nama');
    }
}
$this->registerJsVar('baseurl',yii\helpers\Url::home());
$this->registerJs("function gettunjangan(id){
            $.ajax({
                'type':'post',
                'url':baseurl+'tunjangan/gettunjangan',
                'data':{'id':id},
            }).done(function(data){
                $('.tabtunjangan').html(data);
            });
        }
        gettunjangan($('#transaksipenggajian-data_id').val());
        $(document).on('shown.bs.tab', 'a[data-toggle=\"tab\"]', function (e) {
            var tab = $(e.target);
            var contentId = tab.attr(\"href\");
            if (tab.parent().hasClass('active')) {
                if(tab.html()=='Tunjangan'){
                    gettunjangan($('#transaksipenggajian-data_id').val());
                }
                console.log('the tab with the content id ' + contentId + ' is visible');
            }
        });

    "
);
?>
<div class="transaksi-penggajian-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($transaksipenggajian, 'data_id')->widget(\kartik\select2\Select2::classname(), [
                'data' => $parent,
                'pluginOptions' => [
                    'allowClear' => false
                ],
                'pluginEvents' => [
                    "change" => 'function(){
                        gettunjangan($(this).val());
                    }',
                    ]
            ])
            ?>
            <?= $form->field($transaksipenggajian, 'nomor_transgaji') ?>
            <?= $form->field($transaksipenggajian, 'tgl_gaji')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'masukan tanggal'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($transaksipenggajian, 'tgl_input')->widget(\kartik\date\DatePicker::className(), [
                'options' => ['value' => date("Y-m-d"), 'readonly' => true,],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'autoclose' => true
                ]
            ]); ?>
            <?= $form->field($transaksipenggajian, 'total_brutto_gaji') ?>
            <?= $form->field($transaksipenggajian, 'total_bersih_gaji') ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($transaksipenggajiandetail, 'gol_gaji')->widget(\kartik\select2\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(
                    (new \yii\db\Query())
                        ->from('penggolongangaji')
                        ->rightJoin('m_referensi', 'penggolongangaji.pangkat_id = m_referensi.reff_id')
                        ->where('tipe_referensi = 6')
                        ->all(),
                    'id',
                    'nama_referensi'
                ),
                'options' => ['placeholder' => 'Select  ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Golongan Gaji');
            ?>
            <?= $form->field($transaksipenggajiandetail, 'nominal_val') ?>
            <?= $form->field($potongangaji, 'keterangan')->textArea() ?>
        </div>

    </div>
    <div class="row">
        <?php echo Tabs::widget([
            'items' => [
                [
                    'label' => 'Tunjangan',
                    'content' => '<div class="tabtunjangan">'.Yii::$app->runAction('tunjangan/gettunjangan', ['id'=>'']).'</div>',
                ],
                [
                    'label'=>'Pinjaman',
                    'content' => '<div class="tabpinjaman">'.Yii::$app->runAction('pinjaman/getpinjaman', ['id'=>'']).'</div>',
                ],
            ]
        ]);
        ?>
    </div>
    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($transaksipenggajian->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>
    <?php ActiveForm::end(); ?>
</div>

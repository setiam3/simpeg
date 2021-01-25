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
    $data = \app\models\MBiodata::find()->where(['is_pegawai' => '1', 'id_data' => \Yii::$app->user->identity->id_data])->andWhere(['not', ['jenis_pegawai' => '4']])->andWhere(['not', ['jenis_pegawai' => NULL]])->one();
    $parent = [$data->id_data => $data->namaLengkap];

} elseif (in_array('operator', $role) || in_array('admin', $role)) {
    if (!empty($klikedid)) {
        $parent = ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai' => '1', 'id_data' => $klikedid])->all(), 'id_data', 'namaLengkap');
    } else {
        $parent = $transaksipenggajian->isNewRecord ? ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai' => '1'])->andWhere(['not', ['jenis_pegawai' => '4']])->andWhere(['not', ['jenis_pegawai' => NULL]])->all(), 'id_data', 'namaLengkap') :
        ArrayHelper::map(\app\models\MBiodata::find()->where(['id_data' => $transaksipenggajian->data_id])->all(), 'id_data', 'namaLengkap');
    }
}
$this->registerJsVar('baseurl',Url::home());
if($transaksipenggajian->isNewRecord){
    $this->registerJs("
        jQuery(document).ready(function(){
            $.ajax({
                'type':'get',
                'url':baseurl+'transaksi-penggajian/autonomorgaji'
            }).done(function(data){
                $('#transaksipenggajian-nomor_transgaji').val(data.nomor);
            });

        });"
    );
}

$this->registerJs("
    var gapok={'netto':[],'totaltunjangan':[],'potongan':[]};
        function gettunjangan(id){
            $.ajax({
                'type':'post',
                'url':baseurl+'tunjangan/gettunjangan',
                'data':{'id':id},
            }).done(function(data){
                $('.tabtunjangan').html(data);
                var totaltunjangan=$('.totaltunjangan').val();
                gapok.totaltunjangan.push(totaltunjangan);
                getgajipokok(id);
                //getpinjaman(id);
            });
        }
        function getgajipokok(id){
            $.ajax({
                'type':'post',
                'url':baseurl+'kepangkatan/getgajipokok',
                'data':{'id':id},
            }).done(function(data){
                gapok.netto=[];
                gapok.netto.push(data);
                gajinetto();
                $('#transaksipenggajian-total_brutto_gaji').val(data);
            });
        }
        function gajinetto(){
            var n=0,tt=0,tp=0;
            gapok.netto.forEach(function(a){
                n=Number(a);
            });
            gapok.totaltunjangan.forEach(function(t){
                tt=Number(t);
            });
            gapok.potongan.forEach(function(p){
                tp=Number(p);
            });
            $('#transaksipenggajian-total_bersih_gaji').val(n+=tt-tp);
        }
        function getpinjaman(id){
            $.ajax({
                'type':'post',
                'url':baseurl+'pinjaman/getpinjaman',
                'data':{'id':id},
            }).done(function(data){
                $('.tabpinjaman').html(data);
            });
        }

        gettunjangan($('#transaksipenggajian-data_id').val());
        //getpinjaman($('#transaksipenggajian-data_id').val());
        $(document).on('shown.bs.tab', 'a[data-toggle=\"tab\"]', function (e) {
            var tab = $(e.target);
            var contentId = tab.attr(\"href\");
            if (tab.parent().hasClass('active')) {
                if(tab.html()=='Tunjangan'){
                    gettunjangan($('#transaksipenggajian-data_id').val());
                }
                if(tab.html()=='Pinjaman'){
                    getpinjaman($('#transaksipenggajian-data_id').val());
                }
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
                        getpinjaman($(this).val());
                    }',
                    ]
            ])
            ?>
            <?= $form->field($transaksipenggajian, 'nomor_transgaji') ?>

        </div>
        <div class="col-sm-4">
            <?= $form->field($transaksipenggajian, 'tgl_gaji')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'masukan tanggal'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>
            <?= $form->field($transaksipenggajian, 'tgl_input')->textInput(['value'=>date('Y-m-d')]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($transaksipenggajian, 'total_brutto_gaji')->textInput(['maxlength' => true,'readonly'=>true]) ?>
            <?= $form->field($transaksipenggajian, 'total_bersih_gaji')->textInput(['maxlength' => true,'readonly'=>true]) ?>
        </div>
    </div>
    <div class="row">
        <?php
        $frmpot=($transaksipenggajian->isNewRecord?
        $this->render('_formpotongan',['model'=>$transaksipenggajian])
        :
        $this->render('_formpotongan', ['model'=>$transaksipenggajian,'potongangaji'=>$potongangaji]));
        echo Tabs::widget([
            'items' => [
                [
                    'label' => 'Potongan',
                    'content' => '<div class="tabpotongan">'.$frmpot.'</div>',
                    'active'=>true,
                ],
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
            <?= Html::submitButton($transaksipenggajian->isNewRecord ? 'Create' : 'Update', ['class' => $transaksipenggajian->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>
    <?php ActiveForm::end(); ?>
</div>

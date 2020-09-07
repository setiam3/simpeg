<?php


use app\models\Jatahcuti;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pengajuanijin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengajuanijin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $datas = Jatahcuti::findOne(['id_data' => $model->id_data]);
    //    var_dump($datas);
    //    die();
    //    echo "Sisa Cuti ",$datas['sisa'];
    ?>


    <?= $form->field($model, 'id_data')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai' => '1'])->all(), 'id_data', 'nama'),
        'language' => 'de',
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Nama');
    ?>


    <?= $form->field($model, 'tanggalMulai')->widget(\kartik\date\DatePicker::className(), [
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'tanggalAkhir')->widget(\kartik\date\DatePicker::className(), [
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'alasan')->textArea() ?>


    <?= $form->field($model, 'jenisIjin')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MReferensi::find()->where(['tipe_referensi' => '12'])->all(), 'nama_referensi', 'nama_referensi'),
        'language' => 'de',
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Jenis ijin'); ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>
<div class="pegawai-create">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-6">
            <?php 
            if(!empty($mbiodata->foto) && file_exists(Yii::getAlias('@uploads').$mbiodata->foto)){
                echo Html::img(Yii::getAlias('@web').'/uploads/foto/'.$mbiodata->foto,['class'=>'col-md-12']);
            }
            ?>
                <?= $form->field($mbiodata, 'foto')->fileInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($mpegawai, 'nip') ?>
                <?= $form->field($mbiodata, 'nama') ?>
                <?= $form->field($mbiodata, 'gelarDepan') ?>
                <?= $form->field($mbiodata, 'gelarBelakang') ?>
                <?= $form->field($mbiodata, 'tempatLahir') ?>
                <?= $form->field($mbiodata, 'tanggalLahir') ?>
            </div>
        </div>
        
        <div class="form-group">
            <?= $form->field($mbiodata, 'alamat') ?>
            <?= $form->field($mbiodata, 'kabupatenKota') ?>
            <?= $form->field($mbiodata, 'kecamatan') ?>
            <?= $form->field($mbiodata, 'kelurahan') ?>
        </div>
    </div>
    <div class="col-md-5">
        <?= $form->field($mpegawai, 'statusPegawai')
        ->dropDownList(ArrayHelper::map(Yii::$app->params['statusPegawai'],'key','value')) ?>
        <?= $form->field($mbiodata, 'jenisKelamin')
        ->dropDownList(ArrayHelper::map(Yii::$app->params['jenisKelamin'],'key','value')) ?>
        <?= $form->field($mbiodata, 'agama')
        ->dropDownList(ArrayHelper::map(Yii::$app->params['agama'],'key','value')) ?>
        <?= $form->field($mbiodata, 'nik') ?>
        <?= $form->field($mbiodata, 'npwp') ?>
        <?= $form->field($mbiodata, 'telp') ?>
        <?= $form->field($mbiodata, 'email') ?>
        <?= $form->field($mbiodata, 'statusPerkawinan')
        ->dropDownList(ArrayHelper::map(Yii::$app->params['statusPerkawinan'],'key','value')) ?>
        <?= $form->field($mpegawai, 'status')->checkbox() ?>
    </div>
        <div class="form-group">
            <?= Html::submitButton($mpegawai->isNewRecord? 'Create' : 'Save', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div><!-- pegawai-create -->

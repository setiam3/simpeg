<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>
    <?= Html::errorSummary($model)?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'id_data')->widget(Select2::className(),[
                    'data'=>ArrayHelper::map(\app\models\MBiodata::find()->where(['is_pegawai'=>1])->andWhere(['in',
                    'jenis_pegawai',[1,2,3]])->all(), 'id_data','namalengkap'),
                    'options' => ['placeholder' => 'Select ...'],
                ])->label('Pegawai') ?>
                <?//= $form->field($model, 'password') ?>
                <?//= $form->field($model, 'retypePassword') ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

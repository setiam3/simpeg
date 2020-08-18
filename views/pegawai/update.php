<?php
use yii\helpers\Html;
$this->title = 'Update Pegawai: ' . $mpegawai->nip;
$this->params['breadcrumbs'][] = ['label' => 'Pegawai', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $mpegawai->nip, 'url' => ['view', 'id' => $mpegawai->nip]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pegawai-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'mpegawai'=>$mpegawai,
        'mbiodata'=>$mbiodata
    ]) ?>

</div>

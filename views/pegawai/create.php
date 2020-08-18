<?php
use yii\helpers\Html;
$this->title = 'Tambah Pegawai';
$this->params['breadcrumbs'][] = ['label' => 'Pegawai', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'mpegawai'=>$mpegawai,
        'mbiodata'=>$mbiodata
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penggolongangaji', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mpenggolongangaji-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'Pangkat / Golongan',
                'value' => function ($data) {
                    return $data->pangkat->nama_referensi;

                },
            ],
            'masa_kerja',
            'gaji',
            'status_penggolongan',
            [
                'attribute' => 'jenis_pegawai',
                'value' => function ($data) {
                    return $data->jenisPegawai->nama_referensi;

                },
            ],
        ],
    ]) ?>

</div>

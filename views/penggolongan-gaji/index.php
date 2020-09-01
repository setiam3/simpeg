<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Penggolongangaji';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpenggolongangaji-index">

    <p>
        <?= Html::a('Create Penggolongangaji', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Pangkat / Golongan',
                'value' => 'pangkat.nama_referensi',
            ],
            'masa_kerja',
            'gaji',
            'status_penggolongan',
            [
                'attribute' => 'jenis pegawai',
                'value' => 'jenisPegawai.nama_referensi',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

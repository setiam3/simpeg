<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Data Pinjaman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpinjaman-index">

    <p>
        <?= Html::a('Create Pinjaman', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Nama Pegawai',
                'value' => 'data.nama',
            ],
            'tanggal',
            [
                'attribute' => 'Jenis Pinjaman',
                'value' => 'jens.nama_referensi',
            ],
            'namaBarang',
            //'jumlah',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
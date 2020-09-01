<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Riwayatpendidikan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="riwayatpendidikan-index">

    <p>
        <?= Html::a('Create Riwayatpendidikan', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'Tingkat Pendidikan',
                'value' => 'pendidikan.nama_referensi',
            ],
            'namaSekolah',
            'jurusan',
            //'thLulus',
            //'dokumen',
            'no_ijazah',
            'tgl_ijazah',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

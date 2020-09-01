<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MPenggolongangajiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'M Penggolongangajis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpenggolongangaji-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create M Penggolongangaji', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'pangkat_id',
            'masa_kerja',
            'gaji',
            'status_penggolongan',
            //'ruang',
            ['attribute'=>'jenis_pegawai',
            'value'=>function($data){
                return $data->jenisPegawai->nama_referensi;
            }],
            ['attribute'=>'jenis_pegawai',
            'value'=>'jenisPegawai.nama_referensi'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

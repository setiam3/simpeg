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
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'pangkat_id',
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

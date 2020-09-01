<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MPenggolonganGajiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'M Penggolongan Gajis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpenggolongan-gaji-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create M Penggolongan Gaji', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute' => 'pangkat',
                'value' => 'pangkat.nama_referensi',
            ],
            'masa_kerja',
            'gaji',
            'status_penggolongan',
            [
                'attribute' => 'pangkat',
                'value' => 'jenisPegawai.nama_referensi',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

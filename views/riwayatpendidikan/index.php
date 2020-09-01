<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RiwayatpendidikanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Riwayatpendidikans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="riwayatpendidikan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Riwayatpendidikan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_data',
            'tingkatPendidikan',
            'jurusan',
            'namaSekolah',
            //'thLulus',
            //'dokumen',
            //'no_ijazah',
            //'tgl_ijazah',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

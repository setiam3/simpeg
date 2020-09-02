<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MchecklogPegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mchecklog Pegawais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mchecklog-pegawai-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mchecklog Pegawai', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cheklog_id',
            'checklogpegawai_id',
            'kedatangan',
            'pulang',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

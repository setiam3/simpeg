<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MRiwayatdiklatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'M Riwayatdiklats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mriwayatdiklat-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create M Riwayatdiklat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'id_data',
                'value' => 'data.nama',
            ],
            'namaDiklat',
            'tempat',
            'penyelenggara',
            //'mulai',
            //'selesai',
            //'dokumen',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
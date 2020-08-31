<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MTunjanganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'M Tunjangans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mtunjangan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create M Tunjangan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tunjangan_id',
            'nominal',
            'status',
            'id_data',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

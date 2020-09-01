<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Tunjangan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mtunjangan-index">

    <p>
        <?= Html::a('Create Tunjangan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Nama Tunjangan',
                'value' => 'tunjangan.nama_referensi',
            ],
            'nominal',
            'status',
            [
                'attribute' => 'nama',
                'value' => 'data.nama',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

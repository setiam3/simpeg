<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaktaintegritasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paktaintegritas';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="paktaintegritas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Paktaintegritas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['label'=>'Nama',
                'attribute'=>'id_data',
                'value' => function($data){
                    return $data->namapegawai->nama;
                }],
            'jabatan',
            'tanggal',
            //'ttd',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {cetak}',
                'buttons'=> [
                    'cetak' => function ($url, $model) {
                            return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', $url, [
                                'title' => "Activate",
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]);

                    }
                ]
            ]
//            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>


</div>

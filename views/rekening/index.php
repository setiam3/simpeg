<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MRekeningSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Rekeneing';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrekening-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create M Rekening', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_data',
            [
                'attribute' => 'id_data',
                'value' => 'm_biodata.id_data',
            ],
            'bank_id',
            [
                'attribute' => 'tipe_refrensi',
                'value' => 'm_referensi.nama_referensi',
            ],
            'nomor_rekening',
            'npwp',
            //'fotoNpwp',
            //'fotoRekening',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
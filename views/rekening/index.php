<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MRekeningSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Rekening';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrekening-index">

    <p>
        <?= Html::a('Create M Rekening', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id_data',
                'value' => 'data.nama',
            ],
            [
                'attribute' => 'bank_id',
                'value' => 'bank.nama_referensi',
            ],
            'nomor_rekening',
            'npwp',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php 
    echo app\widgets\Importer::widget(['searchModel'=>$searchModel]);
?>
<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Data Rekening';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrekening-index">

    <p>
        <?= Html::a('Create Rekening', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Nama Pegawai',
                'value' => 'data.nama',
            ],
            [
                'attribute' => 'Nama Bank',
                'value' => 'bank.nama_referensi',
            ],
            'nomor_rekening',
            'npwp',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php
echo app\widgets\Importer::widget(['searchModel' => $searchModel]);
?>
<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\log\Target;

$this->title = 'Paktaintegritas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paktaintegritas-index">
    <p>
        <?= Html::a('Create Paktaintegritas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Nama',
                'attribute' => 'id_data',
                'value' => function ($data) {
                    return $data->namapegawai->nama;
                }
            ],
            'jabatan',
            'tanggal',
            //'ttd',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{cetak} {update} {delete}',
                'buttons' => [
                    'cetak' => function ($url, $model) {
                        return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', $url, [
                            'title' => "Activate", 'target'=>'_blank',
                            'data' => [
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ]
        ],
    ]); ?>
</div>

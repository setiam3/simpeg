<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RiwayatpendidikanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Riwayatpendidikan';
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
            [
                'label' => 'Nama Pegawai',
                'attribute' => 'namaPegawai',
                'value' => 'data.nama',
            ],
            [
                'attribute' => 'Tingkat Pendidikan',
                'value' => 'pendidikan.nama_referensi',
            ],
            'jurusan',
            'namaSekolah',
            //'thLulus',
            //'dokumen',
            //'no_ijazah',
            //'tgl_ijazah',
            //'thMasuk',

            ['class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        $t = '@web/riwayatpendidikan/view?id='.$model->id;
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',Url::to($t),['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip']);
                    },
                    'update'=>function ($url, $model) {
                        $t = '@web/riwayatpendidikan/update?id='.$model->id;
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',Url::to($t));
                    },
                    'delete'=>function ($url, $model) {
                        $t = '@web/riwayatpendidikan/delete?id='.$model->id;
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',Url::to($t),['role'=>'modal-remote','title'=>'Delete', 
                            'data-confirm'=>false, 'data-method'=>false,
                            'data-request-method'=>'post',
                            'data-toggle'=>'tooltip',
                            'data-confirm-title'=>'Are you sure?',
                            'data-confirm-message'=>'Are you sure want to delete this item']);
                    },
                ],
            ],
        ],
    ]); ?>


</div>

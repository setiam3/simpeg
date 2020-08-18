<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MRiwayarjabatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'M Riwayatjabatans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mriwayatjabatan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create M Riwayatjabatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nip',
            'namaJabatan',
            'eselon',
            'noSk',
            //'tglSk',
            //'tmtJabatan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

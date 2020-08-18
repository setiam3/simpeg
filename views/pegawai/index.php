<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
$this->title = 'Pegawai';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-index">
    <p>
        <?= Html::a('Tambah Pegawai', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nip',
            'nama',
            'nik',
            'alamat',
            'jenisKelamin',
            'status',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 

    
    ?>
    <?php Pjax::end(); ?>
</div>

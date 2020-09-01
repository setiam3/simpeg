<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MPenggolonganGaji */

$this->title = "Detil Pengolongan";
$this->params['breadcrumbs'][] = ['label' => 'M Penggolongan Gajis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mpenggolongan-gaji-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'pangkat_id',
            [
                'attribute' => 'pangkat',
                'value' => function ($data) {
                    return $data->pangkat->nama_referensi;

                },
            ],
            'masa_kerja',
            'gaji',
            'status_penggolongan',
//            'ruang',
        ],
    ]) ?>

</div>

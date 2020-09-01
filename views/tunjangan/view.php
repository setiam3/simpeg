<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MTunjangan */

$this->title = "Tunjangan";
$this->params['breadcrumbs'][] = ['label' => 'M Tunjangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mtunjangan-view">

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
            [
                'attribute' => 'tunjangan',
                'value' => function ($data) {
                    return $data->tunjangan->nama_referensi;

                },
            ],
            'nominal',
            'status',
            [
                'attribute' => 'nama',
                'value' => function ($data) {
                    return $data->data->nama;

                },
            ],
        ],
    ]) ?>

</div>

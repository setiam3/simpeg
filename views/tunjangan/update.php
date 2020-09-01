<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MTunjangan */

$this->title = 'Update M Tunjangan: ' . $model->data->nama;
$this->params['breadcrumbs'][] = ['label' => 'M Tunjangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mtunjangan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
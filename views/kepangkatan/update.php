<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MKepangkatan */

$this->title = 'Update M Kepangkatan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'M Kepangkatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mkepangkatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

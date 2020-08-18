<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MRiwayatjabatan */

$this->title = 'Update M Riwayatjabatan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'M Riwayatjabatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mriwayatjabatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

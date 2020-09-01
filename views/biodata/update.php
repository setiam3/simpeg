<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MBiodata */

$this->title = 'Update Biodata: ' . $model->id_data;
$this->params['breadcrumbs'][] = ['label' => 'Biodata', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_data, 'url' => ['view', 'id' => $model->id_data]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mbiodata-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

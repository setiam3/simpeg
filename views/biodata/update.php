<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MBiodata */

$this->title = 'Update M Biodata: ' . $model->id_data;
$this->params['breadcrumbs'][] = ['label' => 'M Biodatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_data, 'url' => ['view', 'id' => $model->id_data]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mbiodata-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

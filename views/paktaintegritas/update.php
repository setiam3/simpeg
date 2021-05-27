<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Paktaintegritas */

$this->title = 'Update Paktaintegritas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Paktaintegritas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="paktaintegritas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Paktaintegritas */

$this->title = 'Create Paktaintegritas';
$this->params['breadcrumbs'][] = ['label' => 'Paktaintegritas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paktaintegritas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

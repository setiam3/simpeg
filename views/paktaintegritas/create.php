<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Paktaintegritas */

$this->title = 'Create Paktaintegritas';
$this->params['breadcrumbs'][] = ['label' => 'Paktaintegritas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paktaintegritas-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MTunjangan */

$this->title = 'Create Tunjangan';
$this->params['breadcrumbs'][] = ['label' => 'Tunjangan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mtunjangan-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

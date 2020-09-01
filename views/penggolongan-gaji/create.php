<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MPenggolongangaji */

$this->title = 'Create Penggolongangaji';
$this->params['breadcrumbs'][] = ['label' => 'Penggolongangaji', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpenggolongangaji-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MPinjaman */

$this->title = 'Create Pinjaman';
$this->params['breadcrumbs'][] = ['label' => 'Pinjaman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpinjaman-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

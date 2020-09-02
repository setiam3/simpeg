<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MRiwayatdiklat */

$this->title = 'Create data Riwayat Diklat';
$this->params['breadcrumbs'][] = ['label' => 'M Riwayatdiklats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mriwayatdiklat-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
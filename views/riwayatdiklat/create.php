<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MRiwayatdiklat */

$this->title = 'Create M Riwayatdiklat';
$this->params['breadcrumbs'][] = ['label' => 'M Riwayatdiklats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mriwayatdiklat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

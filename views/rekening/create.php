<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MRekening */

$this->title = 'Membuat Data Rekening Baru';
$this->params['breadcrumbs'][] = ['label' => 'M Rekenings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrekening-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
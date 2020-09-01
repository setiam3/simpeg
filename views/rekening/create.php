<?php

use yii\helpers\Html;

$this->title = 'Membuat Data Rekening Baru';
$this->params['breadcrumbs'][] = ['label' => 'M Rekenings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrekening-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
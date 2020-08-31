<?php

use yii\helpers\Html;

$this->title = 'Create M Biodata';
$this->params['breadcrumbs'][] = ['label' => 'M Biodatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="mbiodata-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

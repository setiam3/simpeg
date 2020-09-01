<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MKepangkatan */

$this->title = 'Create M Kepangkatan';
$this->params['breadcrumbs'][] = ['label' => 'M Kepangkatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mkepangkatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

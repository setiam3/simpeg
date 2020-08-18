<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MRiwayatjabatan */

$this->title = 'Create M Riwayatjabatan';
$this->params['breadcrumbs'][] = ['label' => 'M Riwayatjabatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mriwayatjabatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

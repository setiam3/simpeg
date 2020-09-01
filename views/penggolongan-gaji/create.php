<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MPenggolonganGaji */

$this->title = 'Create M Penggolongan Gaji';
$this->params['breadcrumbs'][] = ['label' => 'M Penggolongan Gajis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpenggolongan-gaji-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

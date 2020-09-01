<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MPinjaman */

$this->title = 'Create M Pinjaman';
$this->params['breadcrumbs'][] = ['label' => 'M Pinjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpinjaman-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

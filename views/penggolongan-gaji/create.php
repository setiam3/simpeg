<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MPenggolongangaji */

$this->title = 'Create M Penggolongangaji';
$this->params['breadcrumbs'][] = ['label' => 'M Penggolongangajis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpenggolongangaji-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

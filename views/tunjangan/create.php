<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MTunjangan */

$this->title = 'Create M Tunjangan';
$this->params['breadcrumbs'][] = ['label' => 'M Tunjangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mtunjangan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Riwayatjabatan */

?>
<div class="riwayatjabatan-create">
    <?= $this->render('_form', [
        'model' => $model,
        'klikedid' => $klikedid
    ]) ?>
</div>
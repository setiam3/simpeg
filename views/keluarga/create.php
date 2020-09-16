<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MBiodata */

?>
<div class="mbiodata-create">
    <?= $this->render('_form', [
        'model' => $model,
        'klikedid' => $klikedid
    ]) ?>
</div>
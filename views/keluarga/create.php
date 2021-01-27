<?php
use yii\helpers\Html;
?>
<div class="mbiodata-create">
    <?= $this->render('_form', [
        'model' => $model,
        'klikedid' => $klikedid
    ]) ?>
</div>
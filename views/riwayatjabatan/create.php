<?php
use yii\helpers\Html;
?>
<div class="riwayatjabatan-create">
    <?= $this->render('_form', [
        'model' => $model,
        'klikedid'=>$klikedid,
    ]) ?>
</div>
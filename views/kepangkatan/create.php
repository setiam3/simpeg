<?php
use yii\helpers\Html;
?>
<div class="mkepangkatan-create">
    <?= $this->render('_form', [
        'model' => $model,'klikedid'=>$klikedid,
    ]) ?>
</div>

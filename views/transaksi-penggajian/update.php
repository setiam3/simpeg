<?php
use yii\helpers\Html;
?>
<div class="transaksi-penggajian-update">
    <?= $this->render('_form', [
        'transaksipenggajian' => $transaksipenggajian,
        'potongangaji' => $potongangaji
    ]) ?>

</div>
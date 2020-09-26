<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TransaksiPenggajian */

?>
<div class="transaksi-penggajian-create">
    <?= $this->render('_form', [
        'transaksipenggajian' => $transaksipenggajian,
        'potongangaji' => $potongangaji,
        'klikedid' => $klikedid
    ]) ?>
</div>
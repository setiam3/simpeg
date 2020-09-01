<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MBiodata */

$this->title = $model->id_data;
$this->params['breadcrumbs'][] = ['label' => 'Biodata', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mbiodata-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_data], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_data], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_data',
            'parent_id',
            'nip',
            'nama',
            'tempatLahir',
            'tanggalLahir',
            'alamat',
            'kabupatenKota',
            'kecamatan',
            'kelurahan',
            'jenisKelamin',
            'agama',
            'telp',
            'email:email',
            'statusPerkawinan',
            'gelarDepan',
            'gelarBelakang',
            'nik',
            'foto',
            'fotoNik',
            'golonganDarah',
            'status_hubungan_keluarga',
            'is_pegawai',
            'checklog_id',
        ],
    ]) ?>

</div>

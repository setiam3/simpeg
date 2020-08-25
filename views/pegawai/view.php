<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->nip;
$this->params['breadcrumbs'][] = ['label' => 'Pegawai', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pegawai-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->nip], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->nip], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="col-md-6">
    <?= DetailView::widget([
        'model' => $model,
        'options'=>['class'=>'th-right table table-striped table-bordered detail-view'],
        'attributes' => [
            [
                'label'=>'Foto',
                'format'=>'raw',
                'value'=>function($data){
                    return !empty($data->foto)?'<img class="col-xs-6" src="'.Yii::getAlias('@web').'/uploads/foto/'.$data->foto.'"':'';
                }
            ],
            'nip',
            ['label'=>'nama',
                'value'=>function($data){
                    return $data->gelarDepan.' '.$data->nama.' '.$data->gelarBelakang;
                }
            ],
            'statusPegawai',
            ['label'=>'TTL',
                'value'=>function($data){
                    return $data->tempatLahir.', '.$data->tanggalLahir;
                }
            ],
            'alamat',
            ['attribute'=>'kabupatenKota','value'=>$model->desanya->district->regency->name],
            ['attribute'=>'kecamatan','value'=>$model->desanya->district->name],
            ['attribute'=>'kelurahan','value'=>$model->desanya->name],
            'jenisKelamin',
            'agama',
            'telp',
            'email',
            'statusPerkawinan',
            'nik',
            'fotoNik',
            'golonganDarah',
        ],
    ]) ?>
    </div>
    <div class="col-md-6">
        
    </div>

</div>

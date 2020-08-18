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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label'=>'Foto',
                'format'=>'raw',
                'value'=>function($data){
                    return '<img class="col-md-6" src="'.Yii::getAlias('@web').'/uploads/foto/'.$data->foto.'"';
                }
            ],
            'nip',
            'nama',
            
        ],
    ]) ?>

</div>

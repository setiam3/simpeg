<?php ?>
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
            'nip',
            'nama',
            'tempatLahir',
            'tanggalLahir',
            'alamat',
            [
                'attribute'=>'KabupatenKota',
                'value'=>function($data){
                    return $data->desanya->district->regency->name;
                }
            ],
            [
                'attribute'=>'kecamatan',
                'value'=>function($data){
                    return $data->desanya->district->name;
                }
            ],
            [
                'attribute'=>'kelurahan',
                'value'=>function($data){
                    return $data->desanya->name;
                }
            ],
            [
                'attribute'=>'jenisKelamin',
                'value'=>function($data){
                    return $data->sex->nama_referensi;
                }
            ],
            [
                'attribute'=>'agama',
                'value'=>function($data){
                    return $data->agamanya->nama_referensi;
                }
            ],
            'telp',
            'email:email',
            [
                'attribute'=>'statusPerkawinan',
                'value'=>function($data){
                    return $data->statuskawin->nama_referensi;
                }
            ],
            'gelarDepan',
            'gelarBelakang',
            'nik',
            [
                'attribute'=>'Foto',
                'format'=>'html',
                'value'=>function($data){
                    return isset($data->foto) && file_exists(\Yii::getAlias('@uploads').$data->nip.'/'.$data->foto)?Html::a($data->foto,\Yii::getAlias('@web/uploads/foto/'.$data->nip.'/'.$data->foto)):'';
                }
            ],
            [
                'attribute'=>'Foto NIK',
                'format'=>'html',
                'value'=>function($data){
                    return isset($data->fotoNik) && file_exists(\Yii::getAlias('@uploads').$data->nip.'/'.$data->fotoNik)?Html::a($data->fotoNik,\Yii::getAlias('@web/uploads/foto/'.$data->nip.'/'.$data->fotoNik)):'';
                }
            ],
            'golonganDarah',
            [
                'attribute'=>'status_hubungan_keluarga',
                'value'=>function($data){
                    return isset($data->status_hubungan_keluarga)?$data->statusHubunganKeluarga->nama_referensi:'';
                }
            ],
            'is_pegawai',
            'checklog_id',
        ],
    ]) ?>

</div>
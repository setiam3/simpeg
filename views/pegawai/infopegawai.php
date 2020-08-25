<?php 
//info pegawai
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;
use yii\bootstrap\Modal;
use yii\widgets\DetailView;

?>
<div class="col-md-3">
	<a href=<?=Yii::getAlias('@web')."/uploads/foto/$model->foto"?> class="thumbnail">
		<img src=<?=Yii::getAlias('@web')."/uploads/foto/".$model->foto?> /> 
	</a>
	<?=DetailView::widget([
        'model' => $model,
        'options'=>['class'=>'th-right table table-striped table-bordered detail-view'],
        'attributes' => [
            ['attribute'=>'nama',
                'value'=>function($data){
                    return $data->gelarDepan.' '.$data->nama.' '.$data->gelarBelakang;
                }
            ],
            'nip',
            ['label'=>'TTL',
                'value'=>function($data){
                    return $data->tempatLahir.', '.$data->tanggalLahir;
                }
            ],
            ['label'=>'Usia','value'=>function($data){ 
            	return \Yii::$app->tools->getUsia($data->tanggalLahir);
        	}],
            'jenisKelamin',
            'agama',
        ],
    ]);
    $biodata=DetailView::widget([
        'model' => $model,
        'options'=>['class'=>'th-right table table-striped table-bordered detail-view'],
        'attributes' => [
            ['attribute'=>'nama',
                'value'=>function($data){
                    return $data->gelarDepan.' '.$data->nama.' '.$data->gelarBelakang;
                }
            ],
            'nip',
            ['label'=>'TTL',
                'value'=>function($data){
                    return $data->tempatLahir.', '.$data->tanggalLahir;
                }
            ],
            ['label'=>'Usia','value'=>function($data){ 
            	return \Yii::$app->tools->getUsia($data->tanggalLahir);
        	}],
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
<div class="col-md-9">
<?php
		/*echo Collapse::widget([
          'items' => [
            'Jabatan' => 'This is the first collapsable menu',
            'Gaji' => [
                'content' => 'This is the second collapsable menu',
            ],
            'Pendidikan' => [
                'content' => 'This is the second collapsable menu',
            ],'Keluarga' => [
                'content' => 'This is the second collapsable menu',
            ],'Diklat' => [
                'content' => 'This is the second collapsable menu',
            ],'Prestasi' => [
                'content' => 'This is the second collapsable menu',
            ],'Hukuman' => [
                'content' => 'This is the second collapsable menu',
            ],
        ]
      ]);*/

	echo Tabs::widget([
      'items' => [
          [
              'label' => 'Biodata',
              'content' => $biodata,
          ],
          [
              'label' => 'Jabatan',
              'content' => $this->renderAjax('index',[
              	'searchModel' => $searchModel,
            	'dataProvider' => $dataProvider,
            ]),
          ],
          [
              'label' => 'Gaji',
              'content' => 'Anim pariatur cliche...',
              'headerOptions' => ['class'],
              'options' => ['id' => 'myveryownID'],
          ],
          [
              'label' => 'Pendidikan',
              //'url' => 'http://www.example.com',
          ],
          [
              'label' => 'Keluarga',
              'content' => 'Anim pariatur cliche...',
          ],
          [
              'label' => 'Diklat',
              'content' => 'Anim pariatur cliche...',
          ],
          [
              'label' => 'Prestasi',
              'content' => 'Anim pariatur cliche...',
          ],
          [
              'label' => 'Keluarga',
              'items' => [
                   [
                       'label' => 'DropdownA',
                       'content' => 'DropdownA, Anim pariatur cliche...',
                   ],
                   [
                       'label' => 'DropdownB',
                       'content' => 'DropdownB, Anim pariatur cliche...',
                   ],
                   [
                       'label' => 'External Link',
                       'url' => 'http://www.example.com',
                   ],
              ],
          ],
      ],
  ]);

	Modal::begin([
	    "id"=>"ajaxCrudModal",
	    "footer"=>"",
	]);

	// echo $this->renderAjax('_form',[
 //        'mpegawai' => $mpegawai=\app\models\MPegawai::findOne(['nip'=>$model->id]),
 //        'mbiodata'=>\app\models\MBiodata::findOne(['id'=>$mpegawai->fk_biodata])
 //            ]);
 
  	Modal::end();

    ?>
</div>
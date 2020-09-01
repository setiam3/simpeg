<?php 
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;
use yii\bootstrap\Modal;
use yii\widgets\DetailView;
use yii\helpers\Html;
?>
<div class="row">
  

<div class="col-md-3">
  <?php $linkFoto=\Yii::getAlias('@web/uploads/foto/'.$model->nip.'/'.$model->foto);
        if(file_exists(\Yii::getAlias('@uploads').$model->nip.'/'.$model->foto) && !empty($model->foto)){
                echo Html::a(Html::img($linkFoto,['class'=>'col-xs-12']),$linkFoto,['class'=>'']);
        }?>
	
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
            ['label'=>'Usia',
              'value'=>function($data){ 
            	   return \Yii::$app->tools->getUsia($data->tanggalLahir);
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
        ],
    ]);
     ?>
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
              'content' =>$this->render('view', ['model' => $model]),
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
</div>
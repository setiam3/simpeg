<?php
use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'Biodata';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mbiodata-index">

    <?php $gridColumns=[
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'foto',
            'format'=>'html',
            'value' => function ($data) {
                $link=Yii::getAlias('@web/uploads/foto/');
                return isset($data->foto)?
                Html::a(Html::img($link.$data->nip.'/'.$data->foto,['width' => '60px']),['info','id'=>$data->id_data]):
                Html::a(Html::img($link.'avatarfemale.jpg',['width' => '60px']),['info','id'=>$data->id_data]);
            },
        ],
        'nip',
        ['attribute'=>'nama','value'=>function($data){
            return $data->gelarDepan.' '.$data->nama.' '.$data->gelarBelakang;
        }],
        'tempatLahir',
        ['class' => 'yii\grid\ActionColumn',
            'header'=>'Action',
            'headerOptions'=>['class'=>'skip-export'],
            'contentOptions'=>['class'=>'skip-export']
        ],
    ];?>

    <?= GridView::widget([
        'moduleId'=>'gridview',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'hover'=>true,
        'toolbar' => [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>',['create'], [
                        'type'=>'button',
                        'title'=>'Add',
                        'class'=>'btn btn-success'
                    ]),
            ],
            '{export}',
            '{toggleData}'
        ],
        'pjax'=>true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => $this->title,
        ],
        'exportConfig'=>[
            'html' => ['filename'=>str_replace(' ', '',$this->title)],
            'csv' => ['filename'=>str_replace(' ', '',$this->title)],
            'txt' => ['filename'=>str_replace(' ', '',$this->title)],
            'xls' => ['filename'=>str_replace(' ', '',$this->title)],
            'pdf' => ['filename'=>str_replace(' ', '',$this->title)],
            'json' => ['filename'=>str_replace(' ', '',$this->title)],
        ]
    ]);?>
</div>
<?php
    echo app\widgets\Importer::widget(['searchModel'=>$searchModel]);
?>

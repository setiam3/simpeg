<?php
use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'Biodata';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mbiodata-index">

    <?php $gridColumns=[
        ['class' => 'yii\grid\SerialColumn'],
        'nip',
        'nama',
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

<?php
use yii\helpers\Url;
use yii\helpers\Html;
return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'username',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'auth_key',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'password_hash',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'password_reset_token',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_data',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'buttons' => [
            'view' => function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/user/view?id=' . $model->id;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($t), ['role' => 'modal-remote','data-target'=>'#'.$idmodal, 'title' => 'View', 'data-toggle' => 'tooltip']);
            },
            'update' => function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/user/update?id=' . $model->id;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target'=>'#'.$idmodal, 'title' => 'Update', 'data-toggle' => 'tooltip']);
            },
            'delete' => function ($url, $model) {
                $idmodal=md5($model::className());
                $t = '@web/user/delete?id=' . $model->id;
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to($t), [
                    'role' => 'modal-remote', 'data-target'=>'#'.$idmodal, 'title' => 'Delete',
                    'data-confirm' => false, 'data-method' => false,
                    'data-request-method' => 'post',
                    'data-toggle' => 'tooltip',
                    'data-confirm-title' => 'Are you sure?',
                    'data-confirm-message' => 'Are you sure want to delete this item'
                ]);
            },
        ],
    ],

];   
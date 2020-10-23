<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'timeZone'=>'Asia/Jakarta',
    'id' => 'simpeg_v1',
    'name'=>'SIMPEG',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@uploads' => '@app/web/uploads/foto/',
    ],
    'modules'=>[
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu', // it can be '@path/to/your/layout'.
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'mdm\admin\models\User',
                    'idField' => 'id'
                ],
            ],
            'controllerMap' => [
                'assignment' => [
                   'class' => 'mdm\admin\controllers\AssignmentController',
                   /* 'userClassName' => 'app\models\User', */
                   'idField' => 'user_id',
                   'usernameField' => 'username',
                   'fullnameField' => 'profile.full_name',
                   'extraColumns' => [
                       [
                           'attribute' => 'full_name',
                           'label' => 'Full Name',
                           'value' => function($model, $key, $index, $column) {
                               return $model->profile->full_name;
                           },
                       ],
                       [
                           'attribute' => 'dept_name',
                           'label' => 'Department',
                           'value' => function($model, $key, $index, $column) {
                               return $model->profile->dept->name;
                           },
                       ],
                       [
                           'attribute' => 'post_name',
                           'label' => 'Post',
                           'value' => function($model, $key, $index, $column) {
                               return $model->profile->post->name;
                           },
                       ],
                   ],
                   'searchClass' => 'app\models\UserSearch'
               ],
           ],
            'menus' => [
                'assignment' => [
                    'label' => 'Grand Access' // change label
                ],
                //'route' => null, // disable menu route
            ]
        ]
    ],
    'components' => [
        'view' => [
             'theme' => [
                 'pathMap' => [
                    '@app/views' => '@app/views'
                    //'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                 ],
             ],
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-red',
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'rsE2ILrUA0kdVMUW3hQuUKJ_Sfn7h02L',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'enableAutoLogin' => true,
            'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['site/login'],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'tools'=>[
            'class'=>'app\widgets\Tools'
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '',
            'locale'=>'id_ID',
            'defaultTimeZone'=>'Asia/Jakarta',
        ],
        'pdf' => [
            'class' => 'kartik\mpdf\Pdf',
            'format' => 'A4',
            'orientation' => 'P',
            'destination' => 'I',
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            //'admin/*',
            'debug/*',
            'site/login',
            'site/error',
        ]
    ],
    'as beforeRequest' => [  //if guest user access site so, redirect to login page.
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            ['actions' => ['login'],'allow' => true,],
            ['allow' => true,'roles' => ['@'],],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;

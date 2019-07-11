<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'on ' . \yii\web\User::EVENT_AFTER_LOGIN => function () {
                \Yii::info(Yii::$app->user->identity->username, 'auth');
                return;
            }
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@runtime/logs/login.log',
                    'categories' => ['auth'],
                    'logVars' => []
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => yii\rest\UrlRule::class, 'controller' => 'api/user'],
                ['class' => yii\rest\UrlRule::class, 'controller' => 'api/task'],
                ['class' => yii\rest\UrlRule::class, 'controller' => 'api/project'],
                '<controller:[\w-]+>s' => '<controller>/index',
                '<controller:[\w-]+>/<id:\d+>' => '<controller>/view',
                '<controller:[\w-]+>/update/<id:\d+>' => '<controller>/update',
                '<controller:[\w-]+>/delete/<id:\d+>' => '<controller>/delete',
            ],
        ],
    ],
    'modules' => [
        'api' => [
            'class' => 'frontend\modules\api\Module',
        ],
//        https://github.com/yii2mod/yii2-comments
        'comment' => [
            'class' => 'yii2mod\comments\Module',
        ]
    ],
    'params' => $params,
];

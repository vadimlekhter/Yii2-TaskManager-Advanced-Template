<?php

use common\services\AssignRoleEvent;
use common\services\ProjectService;
use common\services\EmailService;
use common\services\NotificationService;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
//        '@web-socket-port' => '8080'
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'projectService' => [
            'class' => ProjectService::class,
            'on ' . ProjectService::EVENT_ASSIGN_ROLE => function (AssignRoleEvent $e) {
                Yii::$app->notificationService->sendNewUserRoleEmail($e);
            }
        ],
        'emailService' => [
            'class' => EmailService::class
        ],
        'notificationService' => [
            'class' => NotificationService::class
        ]
    ],
    'modules' => [
        'chat' => [
            'class' => 'common\modules\chat\Module',
        ],
    ],
];

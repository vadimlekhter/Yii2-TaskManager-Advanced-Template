<?php

use common\services\ChangeRoleEvent;
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
            'on ' . ProjectService::EVENT_ASSIGN_ROLE => function (ChangeRoleEvent $e) {
                Yii::$app->notificationService->sendNewUserRoleEmail($e);
            },
            'on ' . ProjectService::EVENT_CANCEL_ROLE => function (ChangeRoleEvent $e) {
                Yii::$app->notificationService->sendCancelUserRoleEmail($e);
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

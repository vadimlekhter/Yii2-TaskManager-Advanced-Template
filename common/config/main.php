<?php

use common\services\ChangeRoleEvent;
use common\services\ProjectService;
use common\services\EmailService;
use common\services\NotificationService;
use common\services\TaskService;
use common\services\UserService;
use common\services\CommonService;
use \common\services\TakeCompleteTaskEvent;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
//        '@web-socket-port' => '8080'
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'commonService' => [
            'class' => CommonService::class
        ],
        'taskService' => [
            'class' => TaskService::class,
            'on '. TaskService::EVENT_TAKE_TASK => function (TakeCompleteTaskEvent $e) {
                Yii::$app->notificationService->sendTakeTaskEmail($e->user, $e->project, $e->task);
            },
            'on '. TaskService::EVENT_COMPLETE_TASK => function (TakeCompleteTaskEvent $e) {
                Yii::$app->notificationService->sendCompleteTaskEmail($e->user, $e->project, $e->task);
            }
        ],
        'userService' => [
            'class' => UserService::class
        ],
        'i18n' => [
            'translations' => [
                'yii2mod.comments' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/comments/messages',
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'itemFile' => '@console/rbac/items.php',
            'assignmentFile' => '@console/rbac/assignments.php'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'projectService' => [
            'class' => ProjectService::class,
            'on ' . ProjectService::EVENT_ASSIGN_ROLE => function (ChangeRoleEvent $e) {
                Yii::$app->notificationService->sendNewUserRoleEmail($e->user, $e->project, $e->role);
            },
            'on ' . ProjectService::EVENT_CANCEL_ROLE => function (ChangeRoleEvent $e) {
                Yii::$app->notificationService->sendCancelUserRoleEmail($e->user, $e->project, $e->role);
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

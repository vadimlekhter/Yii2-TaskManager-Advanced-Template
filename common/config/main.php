<?php

use common\services\AssignRoleEvent;
use common\services\ProjectService;
use common\services\EmailService;

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
                $views = ['html' => 'newUserRole-html', 'text' => 'newUserRole-text'];
                $data = ['user' => $e->user, 'project' => $e->project, 'role' => $e->role];
                Yii::$app->emailService->sendEmail($e->user->email, 'Новая роль', $views, $data);
            }
        ],
        'emailService' => [
            'class' => EmailService::class
        ]
    ],
    'modules' => [
        'chat' => [
            'class' => 'common\modules\chat\Module',
        ],
    ],
];

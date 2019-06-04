<?php


namespace common\services;

use Yii;

/**
 * Class NotificationService
 * @package common\services
 */
class NotificationService
{
    /**
     * Email to user with new role in project
     * @param AssignRoleEvent $e
     */
    public function sendNewUserRoleEmail($e)
    {
        $views = ['html' => 'newUserRole-html', 'text' => 'newUserRole-text'];
        $data = ['user' => $e->user, 'project' => $e->project, 'role' => $e->role];
        Yii::$app->emailService->sendEmail($e->user->email, 'New role', $views, $data);
    }
}
<?php


namespace common\services;

use common\models\Project;
use common\models\User;
use Yii;

/**
 * Class NotificationService
 * @package common\services
 */
class NotificationService
{
    /**
     * Email to user with new role in project
     * @param User $user
     * @param Project $project
     * @param string $role
     */
    public function sendNewUserRoleEmail($user, $project, $role)
    {
        $views = ['html' => 'newUserRole-html', 'text' => 'newUserRole-text'];
        $data = ['user' => $user, 'project' => $project, 'role' => $role];
        Yii::$app->emailService->sendEmail($user->email, 'New role', $views, $data);
    }

    /**
     * Email to user with cancelled role in project
     * @param User $user
     * @param Project $project
     * @param string $role
     */
    public function sendCancelUserRoleEmail($user, $project, $role)
    {
        $views = ['html' => 'cancelUserRole-html', 'text' => 'cancelUserRole-text'];
        $data = ['user' => $user, 'project' => $project, 'role' => $role];
        Yii::$app->emailService->sendEmail($user->email, 'Cancel role', $views, $data);
    }
}
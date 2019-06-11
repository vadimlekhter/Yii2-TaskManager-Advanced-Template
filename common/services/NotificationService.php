<?php


namespace common\services;

use common\interfaces\EmailServiceInterface;
use common\models\Project;
use common\models\User;
use common\models\Task;
use Yii;
use yii\base\Component;

/**
 * Class NotificationService
 * @package common\services
 */
class NotificationService extends Component
{
    protected $emailService;

    /**
     * NotificationService constructor.
     * @param $emailService EmailService
     * @param $config array
     */
    public function __construct(EmailServiceInterface $emailService, array $config = [])
    {
        parent::__construct($config);
        $this->emailService = $emailService;
    }


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
        $this->emailService->send($user->email, 'New role', $views, $data);
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
        $this->emailService->send($user->email, 'Cancel role', $views, $data);
    }

    /**
     * Email to developer & managers about taken task
     * @param User $user
     * @param Project $project
     * @param Task $task
     */
    public function sendTakeTaskEmail ($user, $project, $task) {
        $views = ['html' => 'takeTask-html', 'text' => 'takeTask-text'];
        $data = ['user' => $user, 'project' => $project, 'task' => $task];
        $this->emailService->send($user->email, 'Taken task', $views, $data);
    }

    /**
     * Email to developer & managers about completed task
     * @param User $user
     * @param Project $project
     * @param Task $task
     */
    public function sendCompleteTaskEmail ($user, $project, $task) {
        $views = ['html' => 'completeTask-html', 'text' => 'completeTask-text'];
        $data = ['user' => $user, 'project' => $project, 'task' => $task];
        $this->emailService->send($user->email, 'Completed task', $views, $data);
    }
}
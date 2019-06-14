<?php


namespace common\services;

use common\models\Project;
use common\models\ProjectUser;
use common\models\User;
use Yii;
use yii\base\Component;
use yii\base\Event;

/**
 * Class AssignRoleEvent
 * @package common\services
 */
class ChangeRoleEvent extends Event
{
    /**
     * @var Project $project
     */
    public $project;
    /**
     * @var User $user
     */
    public $user;
    /**
     * @var string
     */
    public $role;
}

/**
 * Class ProjectService
 * @package common\services
 */
class ProjectService extends Component
{
    const EVENT_ASSIGN_ROLE = 'event_assign_role';
    const EVENT_CANCEL_ROLE = 'event_cancel_role';

    /**
     * @param Project $project
     * @return bool
     */
    public function sendEmailAssignCancelRole(Project $project)
    {
        $usersRoles = $project->getUserRoles();

        if ($project->save()) {
            if ($newRoles = array_diff_assoc($project->getUserRoles(), $usersRoles)) {
                foreach ($newRoles as $userId => $newRole) {
                    $this->assignRole($project, User::findOne($userId), $newRole);
                }
            }
            if ($oldRoles = array_diff_assoc($usersRoles, $project->getUserRoles())) {
                foreach ($oldRoles as $userId => $oldRole) {
                    $this->cancelRole($project, User::findOne($userId), $oldRole);
                }
            }
            return true;
        } else
            return false;
    }

    /**
     * @param Project $project
     * @param User $user
     * @param string $role
     */
    public function assignRole(Project $project, User $user, $role)
    {
        $event = $this->createChangeRoleEvent($project, $user, $role);
        $this->trigger(self::EVENT_ASSIGN_ROLE, $event);
    }

    /**
     * @param Project $project
     * @param User $user
     * @param string $role
     */
    public function cancelRole(Project $project, User $user, $role)
    {
        $event = $this->createChangeRoleEvent($project, $user, $role);
        $this->trigger(self::EVENT_CANCEL_ROLE, $event);
    }

    /**
     * @param Project $project
     * @param User $user
     * @param string $role
     * @return ChangeRoleEvent $event
     */
    private function createChangeRoleEvent(Project $project, User $user, $role)
    {
        $event = new ChangeRoleEvent();
        $event->project = $project;
        $event->user = $user;
        $event->role = $role;
        return $event;
    }

    /**
     * @param Project $project
     * @param User $user
     * @return array
     */
    public function getRoles(Project $project, User $user)
    {
        return $project
            ->getProjectUsers()
            ->byUser($user->id)
            ->select('role')
            ->column();
    }

    /**
     * @param Project $project
     * @param User $user
     * @param string $role
     * @return bool
     */
    public function hasRole(Project $project, User $user, $role)
    {
        return in_array($role, $this->getRoles($project, $user));
    }

    /**
     * @param Project $project
     * @param string $role
     * @return array
     */
    public function getUsersIdbyRoleInProject(Project $project, $role)
    {
        return $project
            ->getProjectUsers()
            ->select('user_id')
            ->where(['role' => $role])
            ->column();
    }
}
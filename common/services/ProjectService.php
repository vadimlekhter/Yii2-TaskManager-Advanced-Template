<?php


namespace common\services;

use common\models\Project;
use common\models\User;
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
        return $project->getProjectUsers()->byUser($user->id)->select('role')->column();
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
}
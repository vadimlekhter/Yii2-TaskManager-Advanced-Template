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
class AssignRoleEvent extends Event
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

    /**
     * @param Project $project
     * @param User $user
     * @param $role string
     */
    public function assignRole(Project $project, User $user, $role)
    {
        $event = new AssignRoleEvent();
        $event->project = $project;
        $event->user = $user;
        $event->role = $role;
        $this->trigger(self::EVENT_ASSIGN_ROLE, $event);
    }
}
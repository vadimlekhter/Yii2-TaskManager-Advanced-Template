<?php

namespace common\models\query;

use common\models\Project;
use common\models\Task;

/**
 * This is the ActiveQuery class for [[\common\models\Task]].
 *
 * @see \common\models\Task
 */
class TaskQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @param int $userId
     * @param null|string $role
     * @return TaskQuery
     */
    public function byUser($userId, $role = null)
    {
        $query = Project::find()->select('id')->byUser($userId, $role);

        return $this->andWhere(['project_id' => $query]);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Task[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Task|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

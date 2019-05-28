<?php

namespace frontend\modules\api\models;

use common\models\Task as TaskCommon;
use yii\helpers\StringHelper;

class Task extends TaskCommon
{
    protected $classUser = User::class;
    protected $classProject = Project::class;

    public function fields()
    {
        return [
            'ID' => 'id',
            'Title' => 'title',
            'Description_short' => function ($model) {
                return StringHelper::truncate($this->description, 50);
            }
        ];
    }

    public function extraFields()
    {
        return [self::RELATION_PROJECT, self::RELATION_CREATOR];
    }
}
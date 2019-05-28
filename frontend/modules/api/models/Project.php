<?php

namespace frontend\modules\api\models;

use common\models\Project as ProjectCommon;
use yii\helpers\StringHelper;

class Project extends ProjectCommon
{
    protected $classTask = Task::class;
    protected $classUser = User::class;

    public function fields()
    {
        return [
            'ID' => 'id',
            'Title' => 'title',
            'Description_short' => function ($model) {
                return  StringHelper::truncate($this->description, 50);
            },
            'Active' => 'active'
        ];
    }

    public function extraFields()
    {
        return [self::RELATION_TASKS];
    }
}
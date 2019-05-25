<?php

namespace frontend\modules\api\models;

use common\models\Project as ProjectCommon;

class Project extends ProjectCommon
{
    public function fields()
    {
        return [
            'ID' => 'id',
            'Title' => 'title',
            'Description_short' => function ($model) {
                return substr($this->description, 0, 50);
            },
            'Active' => 'active'
        ];
    }

    public function extraFields()
    {
        return ['tasks'];
    }


}
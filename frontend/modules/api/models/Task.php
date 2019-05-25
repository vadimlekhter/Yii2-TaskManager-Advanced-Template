<?php

namespace frontend\modules\api\models;

use common\models\Task as TaskCommon;

class Task extends TaskCommon
{
    public function fields()
    {
        return [
            'ID' => 'id',
            'Title' => 'title',
            'Description_short' => function ($model) {
                return substr($this->description, 0, 50);
            }
        ];
    }

    public function extraFields()
    {
        return ['project', 'creator'];
    }

//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getCreator()
//    {
//        return $this->hasOne(User::className(), ['id' => 'creator_id']);
//    }

}
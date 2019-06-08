<?php


namespace common\models\query;


use common\models\User;

/**
 * This is the ActiveQuery class for [[\common\models\User]].
 *
 * @see \common\models\User
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /**
     * @return $this
     */
    public function onlyActive()
    {
        $this->andWhere(['status' => User::STATUS_ACTIVE]);
        return $this;
    }
}
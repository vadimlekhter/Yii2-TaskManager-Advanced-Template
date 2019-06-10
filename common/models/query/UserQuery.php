<?php


namespace common\models\query;


use common\models\ProjectUser;
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

    /**
     * @param string $role
     * @return UserQuery
     */
    public function andRole($role)
    {
        $query = ProjectUser::find()->select('user_id')->where(['role' => $role]);
        return $this->andWhere(['id' => $query]);
    }

    /**
     * @param string $role
     * @return UserQuery
     */
    public function orRole($role)
    {
        $query = ProjectUser::find()->select('user_id')->where(['role' => $role]);
        return $this->orWhere(['id' => $query]);
    }
}
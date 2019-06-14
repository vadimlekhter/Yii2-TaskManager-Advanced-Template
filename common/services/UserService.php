<?php


namespace common\services;


use common\models\ProjectUser;
use Yii;
use yii\base\Component;


/**
 * Class UserService
 * @package common\services
 */
class UserService extends Component
{
    /**
     * @return array
     */
    public function getAllRoles () {
        return ProjectUser::find()
            ->select('role')
            ->byUser(Yii::$app->user->id)
            ->column();
    }
}
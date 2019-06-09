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
    public function getRole () {
        return ProjectUser::find()
            ->select('role')
            ->where(['user_id' => Yii::$app->user->id])
            ->column();
    }
}
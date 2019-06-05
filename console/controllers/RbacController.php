<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $user = $auth->createRole('user');
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $user);

//        $auth->assign($user, 2);
//        $auth->assign($user, 3);
//        $auth->assign($user, 4);
//        $auth->assign($user, 5);
//        $auth->assign($user, 6);
//        $auth->assign($user, 1);

        $allUsersId = User::find()->select(['id'])->column();

        foreach ($allUsersId as $userId) {
            $auth->assign($user, $userId);
        }

        foreach (Yii::$app->params['admins'] as $adminId) {
            $auth->assign($admin, $adminId);
        }
    }
}
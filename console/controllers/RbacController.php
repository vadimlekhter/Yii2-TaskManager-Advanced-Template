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

        $allUsersId = User::find()->select(['id'])->column();

        foreach (Yii::$app->params['admins'] as $adminId) {
            $auth->assign($admin, $adminId);
        }

        foreach ($allUsersId as $userId) {
            if (!Yii::$app->authManager->getAssignments($userId) == 'admin')
            $auth->assign($user, $userId);
        }


    }
}
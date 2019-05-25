<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

/**
 * User controller for the `api` module
 */
class UserController extends ActiveController
{
    public $modelClass = User::class;

//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => HttpBasicAuth::className(),
//            'class' => HttpBearerAuth::className(),
//        ];
//        return $behaviors;
//    }
}



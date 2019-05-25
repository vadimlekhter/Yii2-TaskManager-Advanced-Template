<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\Task;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;

/**
 * Task controller for the `api` module
 */
class TaskController extends Controller
{

public function actionIndex () {
    return new ActiveDataProvider([
        'query' => Task::find(),
        'pagination' => [
            'pageSize' => 2
        ]
    ]);
}

public function actionView ($id) {
    return Task::findOne($id);
}

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
<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\Project;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

/**
 * Project controller for the `api` module
 */
class ProjectController extends ActiveController
{
public $modelClass = Project::class;

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
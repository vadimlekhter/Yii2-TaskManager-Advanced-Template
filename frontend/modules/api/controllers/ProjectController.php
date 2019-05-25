<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\Project;
use yii\rest\ActiveController;

/**
 * Project controller for the `api` module
 */
class ProjectController extends ActiveController
{
public $modelClass = Project::class;
}
<?php

use common\models\Project;
use common\models\Task;
use common\models\User;
use \yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $project common\models\Project */
/* @var $task common\models\Task */
?>

Hello <?= Html::encode($user->username) ?>, task "<?= $task->title ?>"
from project "<?= Html::encode($project->title) ?>" was completed.

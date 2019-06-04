<?php

use \yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $project common\models\Project */
/* @var $role string */
 ?>

Hello <?= Html::encode($user->username) ?>, you have new role "<?= $role ?>" in "<?= Html::encode($project->title) ?>" project.
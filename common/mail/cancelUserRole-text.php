<?php

use \yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $project common\models\Project */
/* @var $role string */
?>

Hello <?= Html::encode($user->username) ?>, your role "<?= $role ?>" in "<?= Html::encode($project->title) ?>" was cancelled.

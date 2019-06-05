<?php

use \yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $project common\models\Project */
/* @var $role string */
?>

<div class="verify-email">
    <p>Hello <?= Html::encode($user->username) ?>, your role "<?= $role ?>" in "<?= \yii\helpers\Html::encode($project->title) ?>" project was cancelled</p>
</div>
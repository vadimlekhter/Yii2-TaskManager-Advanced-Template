<?php

use \yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $project common\models\Project */
/* @var $role string */
?>

<div class="verify-email">
    <p>Hello <?= Html::encode($user->username) ?>, you have new role "<?= $role ?>" in "<?= \yii\helpers\Html::encode($project->title) ?>" project.</p>
</div>

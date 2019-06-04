<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $project common\models\Project */
/* @var $role string */
?>

<div class="verify-email">
    <p>Hello <?= $user->username ?>, you have new role <?= $role ?> in <?= $project->title ?> project.</p>
</div>

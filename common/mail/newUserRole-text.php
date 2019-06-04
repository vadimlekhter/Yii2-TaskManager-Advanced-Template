<?php

use common\models\User;
use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $project common\models\Project */
/* @var $role string */
 ?>

Hello <?= $user->username ?>, you have new role <?= $role ?> in <?= $project->title ?> project.
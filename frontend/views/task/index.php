<?php

use common\models\Project;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \common\models\Task;
use \common\models\User;
use \common\models\ProjectUser;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?php
        if (in_array(ProjectUser::ROLE_MANAGER, Yii::$app->userService->getAllRoles())) {
            echo Html::a('Create Task', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'label' => 'Project title',
                'attribute' => 'project_id',

                'content' => function (Task $model) {
                    return Html::a($model->project->title, ['project/view', 'id' => $model->project_id]);
                },

                'format' => 'html',
                'filter' => Project::find()
                    ->select('title')
                    ->byUser(Yii::$app->user->id)
                    ->indexBy('id')
                    ->column(),
            ],
            'title',
            'description:ntext',

            ['attribute' => 'executor_id',
                'label' => 'Executor username',
                'value' => function (Task $model) {
                    return (!is_null($model->executor_id)) ?
                        Html::a($model->executor->username, ['user/view', 'id' => $model->executor_id]) : 'Нет';
                },
                'format' => 'html',
                'filter' => User::find()
                    ->select('username')
                    ->onlyActive()
                    ->andRole(ProjectUser::ROLE_DEVELOPER)
                    ->indexBy('id')
                    ->column(),
            ],
            'started_at:datetime',
            'completed_at:datetime',
            ['attribute' => 'creator_id',
                'label' => 'Creator username',
                'value' => function (Task $model) {
                    return Html::a($model->creator->username, ['user/view', 'id' => $model->creator_id]);
                },
                'format' => 'html',
                'filter' => User::find()
                    ->select('username')
                    ->onlyActive()
                    ->andRole(ProjectUser::ROLE_MANAGER)
                    ->indexBy('id')
                    ->column(),
            ],
            ['attribute' => 'updater_id',
                'label' => 'Updater username',
                'value' => function (Task $model) {
                    return Html::a($model->updater->username, ['user/view', 'id' => $model->updater_id]);
                },
                'format' => 'html',
                'filter' => User::find()
                    ->select('username')
                    ->onlyActive()
                    ->andRole(ProjectUser::ROLE_MANAGER)
                    ->orRole(ProjectUser::ROLE_DEVELOPER)
                    ->indexBy('id')
                    ->column(),
            ],
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {take} {complete}',
                'buttons' => [
                    'take' => function ($url, Task $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('hand-right');
                        return Html::a($icon, ['task/take', 'id' => $model->id], ['data' => [
                            'confirm' => 'Take task?',
                            'method' => 'post'
                        ]]);
                    },
                    'complete' => function ($url, Task $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('ok');
                        return Html::a($icon, ['task/complete', 'id' => $model->id], ['data' => [
                            'confirm' => 'Complete task?',
                            'method' => 'post'
                        ]]);
                    }
                ],
                'visibleButtons' => [
                    'update' => function (Task $model, $key, $index) {
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },
                    'delete' => function (Task $model, $key, $index) {
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },
                    'take' => function (Task $model, $key, $index) {
                        return Yii::$app->taskService->canTake($model, Yii::$app->user->identity);
                    },
                    'complete' => function (Task $model, $key, $index) {
                        return Yii::$app->taskService->canComplete($model, Yii::$app->user->identity);
                    }
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

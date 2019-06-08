<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \common\models\Task;
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
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'Project title',
                'value' => function (Task $model) {
                    return Html::a($model->project->title, ['project/view', 'id' => $model->project_id]);
                },
                'format' => 'html'
            ],
            'title',
            'description:ntext',
            'project_id',
            ['attribute' => 'executor_id',
                'value' => function (Task $model) {
                    if (!is_null($model->executor_id)) {
                        return Html::a($model->executor->username, ['user/view', 'id' => $model->executor_id]);
                    }
                    return null;
                },
                'format' => 'html'
            ],
            'started_at:datetime',
            'completed_at',
            ['attribute' => 'creator_id',
                'value' => function (Task $model) {
                    return Html::a($model->creator->username, ['user/view', 'id' => $model->creator_id]);
                },
                'format' => 'html'
            ],
            ['attribute' => 'updater_id',
                'value' => function (Task $model) {
                    return Html::a($model->updater->username, ['user/view', 'id' => $model->updater_id]);
                },
                'format' => 'html'
            ],
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {take}',
                'buttons' => [
                    'take' => function ($url, Task $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('hand-right');
                        return Html::a($icon, ['task/take', 'id' => $model->id], ['data' => [
                            'confirm' => 'Берете задачу?',
                            'method' => 'post'
                        ]]);
                    }
                ],
                'visibleButtons' => [
                    'update' => function (Task $model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_MANAGER);
                    },
                    'delete' => function (Task $model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_MANAGER);
                    },
                    'take' => function (Task $model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_DEVELOPER);
                    }
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii2mod\comments\widgets\Comment;

/* @var $this yii\web\View */
/* @var $model common\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity)) {

            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);

            echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        };

        if (Yii::$app->taskService->canTake($model, Yii::$app->user->identity)) {
            echo Html::a('Take', ['task/take', 'id' => $model->id], [
                'class' => 'btn btn-info',
                'data' => [
                    'confirm' => 'Take task?',
                    'method' => 'post',
                ],
            ]);
        }

        if (Yii::$app->taskService->canComplete($model, Yii::$app->user->identity)) {
            echo Html::a('Complete', ['task/complete', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Complete task?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>


    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'title',
            'description:ntext',
//            'project_id',
            [
                'attribute' => 'Project title',
                'value' => function (\common\models\Task $model) {
                    return Html::a($model->project->title, ['project/view', 'id' => $model->project_id]);
                },
                'format' => 'html'
            ],
//            'executor_id',
            [
                'attribute' => 'Executor name',
                'value' => function (\common\models\Task $model) {
                    if (!is_null($model->executor_id)) {
                        return Html::a($model->executor->username, ['user/view', 'id' => $model->executor_id]);
                    }
                    return 'Нет исполнителя';
                },
                'format' => 'html'
            ],
            'started_at:datetime',
            'completed_at:datetime',
//            'creator_id',
            [
                'attribute' => 'Creator username',
                'value' => function (\common\models\Task $model) {
                    return Html::a($model->creator->username, ['user/view', 'id' => $model->creator_id]);
                },
                'format' => 'html'
            ],
//            'updater_id',
            [
                'attribute' => 'Updater username',
                'value' => function (\common\models\Task $model) {
                    return Html::a($model->updater->username, ['user/view', 'id' => $model->updater_id]);
                },
                'format' => 'html'
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <!--    https://github.com/yii2mod/yii2-comments-->
    <?php echo Comment::widget([
        'model' => $model,
    ]); ?>


</div>

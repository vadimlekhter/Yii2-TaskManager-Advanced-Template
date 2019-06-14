<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \common\models\Project;
use \common\models\ProjectUser;
use \yii\grid\GridView;
use \yii2mod\comments\widgets\Comment;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            ['attribute' => 'active',
                'value' => function ($model) {
                    return Project::STATUS_LABELS[$model->active];
                }
            ],
            'creator_id',
            'updater_id',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <?php
    if (!$dataProvider == null) {
        echo '<h2>Project users</h2>';
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'label' => 'User',
                    'value' => function (ProjectUser $model) {
                        return Html::a($model->user->username,
                            ['user/view', 'id' => $model->user_id]);
                    },
                    'format' => 'html'],
                'role',
            ]]);
    }
    ?>

<!--    https://github.com/yii2mod/yii2-comments-->
    <?php echo Comment::widget([
        'model' => $model,
    ]); ?>

</div>

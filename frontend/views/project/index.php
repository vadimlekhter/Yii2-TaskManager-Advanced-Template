<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \common\models\Project;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'title',
                'value' => function (Project $model) {
                    return Html::a($model->title, ['project/view', 'id' => $model->id]);
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'description',
                'value' => 'description',
                'enableSorting' => false
            ],
            [
                'attribute' => Project::RELATION_PROJECT_USERS . '.role',
                'value' => function (Project $model) {
                    return join(',', Yii::$app->projectService->getRoles($model, Yii::$app->user->identity));
                }
            ],
            [
                'attribute' => 'active',
                'content' => function ($model) {
                    return Project::STATUS_LABELS[$model->active];
                },
                'filter' => Project::STATUS_LABELS
            ],
            [
                'attribute' => 'creator_id',
                'value' => function (Project $model) {
                    return Html::a($model->creator->username, ['user/view', 'id' => $model->creator_id]);
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'updater_id',
                'value' => function (Project $model) {
                    return Html::a($model->updater->username, ['user/view', 'id' => $model->updater_id]);
                },
                'format' => 'html'
            ],
            'created_at:datetime',
            'updated_at:datetime',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

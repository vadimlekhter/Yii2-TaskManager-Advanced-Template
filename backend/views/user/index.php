<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use  \common\models\User;
use \yii2mod\comments\widgets\Comment;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'email:email',
            ['attribute' => 'status',
                'content' => function ($user) {
                return User::STATUS_LABELS[$user->status];
                },
                'filter' => User::STATUS_LABELS
            ],
            'created_at:datetime',
            'updated_at:datetime',
            //'verification_token',
            //'access_token',
//            'avatar',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

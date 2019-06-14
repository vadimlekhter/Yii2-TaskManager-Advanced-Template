<?php

use yii\helpers\Html;
use \common\models\Project;
use \unclead\multipleinput\MultipleInput;
use \common\models\ProjectUser;
use \yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $users common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(
        ['options' => ['enctype' => 'multipart/form-data'],
            'layout' => 'horizontal',
            'fieldConfig' => [
                'horizontalCssClasses' => ['label' => 'col-sm-2',]
            ]
        ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->dropDownList(Project::STATUS_LABELS) ?>

    <?php
    if (!$model->isNewRecord) {
        //https://github.com/unclead/yii2-multiple-input
        echo $form->field($model, Project::RELATION_PROJECT_USERS)->widget(MultipleInput::className(), [
            'id' => 'project-users-widget',
            'max' => 10,
            'min' => 0,
            'addButtonPosition' => MultipleInput::POS_HEADER,
            'columns' => [
                [
                    'name' => 'project_id',
                    'type' => 'hiddenInput',
                    'defaultValue' => $model->id,
                ],
                [
                    'name' => 'user_id',
                    'type' => 'dropDownList',
                    'title' => 'Пользователь',
                    'items' => $users,
                ],
                [
                    'name' => 'role',
                    'type' => 'dropDownList',
                    'title' => 'Роль',
                    'items' => ProjectUser::ROLE_LABELS,
                ],
            ]
        ])
            ->label(false);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

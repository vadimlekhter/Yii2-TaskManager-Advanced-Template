<?php

use yii\helpers\Html;
use common\models\User;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\bootstrap\ActiveForm */

?>

<div class="user-form container">


    <?php $form = ActiveForm::begin(
        ['options' => ['enctype' => 'multipart/form-data'],
            'layout' => 'horizontal',
            'fieldConfig' => [
                'horizontalCssClasses' => ['label' => 'col-sm-2',]
            ]
        ]); ?>

    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'password')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'status')->dropDownList(User::STATUS_LABELS) ?>
    <?=
    //    https://github.com/mohorev/yii2-upload-behavior
    //    https://github.com/yiisoft/yii2-imagine
    $form->field($model, 'avatar')
        ->fileInput(['accept' => 'image/*'])
        ->label('Photo' . '<br>' . Html::img($model->getThumbUploadUrl('avatar', \common\models\User::AVATAR_PREVIEW)))
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

namespace common\modules\chat\widgets;

use common\modules\chat\widgets\assets\ChatAsset;
use yii\web\View;

class Chat extends \yii\bootstrap\Widget
{
    public $port;

    public function init()
    {
        ChatAsset::register($this->view);
        $this->view->registerJsVar('wsPort', $this->port);
        $this->view->registerJsVar('userName', \Yii::$app->user->identity->username);
    }


    public function run()
    {
        return $this->render('chat');
    }
}

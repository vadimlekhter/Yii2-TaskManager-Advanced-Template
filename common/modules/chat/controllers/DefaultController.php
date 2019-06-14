<?php

namespace common\modules\chat\controllers;

use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use yii\console\Controller;
use Ratchet\Server\IoServer;
use common\modules\chat\components\Chat;

/**
 * Default controller for the `chat` module
 */
class DefaultController extends Controller
{

    public function actionIndex()
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
//            \Yii::getAlias('@web-socket-port')
            \Yii::$app->params['chat.port']
        );

        echo 'Server starts' . PHP_EOL;
        $server->run();
        echo 'Server stops';
    }
}
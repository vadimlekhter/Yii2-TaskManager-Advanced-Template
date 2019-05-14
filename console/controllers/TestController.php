<?php

namespace console\controllers;


use yii\console\Controller;

/**
 * Test controller
 */
class TestController extends Controller
{


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        echo 'Hello, world';
    }

}
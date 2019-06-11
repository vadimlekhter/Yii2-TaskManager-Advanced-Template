<?php


namespace common\services;


use Yii;
use yii\base\Component;

/**
 * Class CommonService
 * @package common\services
 */
class CommonService extends Component
{
    /**
     * @return int
     */
    public function getRequestId()
    {
        $id = Yii::$app->request->get('id');
        $id = isset($id) ? $id : Yii::$app->request->post('id');
        return $id;
    }
}
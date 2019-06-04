<?php


namespace common\services;


use Yii;
use yii\base\Component;

/**
 * Class EmailService
 * @package common\services
 */
class EmailService extends Component
{
    /**
     * @param $to string
     * @param $subject string
     * @param $views array
     * @param $data array
     */
    public function sendEmail($to, $subject, $views, $data)
    {
        Yii::$app
            ->mailer
            ->compose(
                $views,
                $data
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($to)
            ->setSubject($subject)
            ->send();
    }
}
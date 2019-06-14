<?php


namespace common\services;


use common\interfaces\EmailServiceInterface;
use Yii;
use yii\base\Component;

/**
 * Class EmailService
 * @package common\services
 */
class EmailService extends Component implements EmailServiceInterface
{
    /**
     * @param $to string
     * @param $subject string
     * @param $views array
     * @param $data array
     */
    public function send($to, $subject, $views, $data)
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
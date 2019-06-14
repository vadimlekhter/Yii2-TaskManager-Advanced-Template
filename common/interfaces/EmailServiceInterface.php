<?php


namespace common\interfaces;


interface EmailServiceInterface
{
    public function send($to, $subject, $views, $data);
}
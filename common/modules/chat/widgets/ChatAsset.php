<?php

namespace common\modules\chat\widgets;

use yii\web\AssetBundle;

/**
 * Chat widget asset bundle.
 */
class ChatAsset extends AssetBundle
{
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
    public $sourcePath = '@common/modules/chat/widgets/assets';
    public $css = [
        'css/chat.css',
    ];
    public $js = [
        'js/chat.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

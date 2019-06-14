<?php

namespace frontend\modules\api\models;

use common\models\User as UserCommon;

class User extends UserCommon
{
    public function fields()
    {
        return ['ID' => 'id'];
    }
}
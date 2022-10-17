<?php

namespace frontend\modules\api\models;

class User extends \common\models\User
{
    public function fields(): array
    {
        return [
            'id',
            'email',
            'access_token',
            'access_token_expired_at'
        ];
    }

    public function extraFields(): array
    {
        return [];
    }
}
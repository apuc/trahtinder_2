<?php

namespace frontend\modules\api\models;

class City extends \common\models\City
{
    public function fields(): array
    {
        return [
            'id',
            'title'
        ];
    }

    public function extraFields(): array
    {
        return [];
    }
}
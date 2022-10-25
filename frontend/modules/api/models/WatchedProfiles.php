<?php

namespace frontend\modules\api\models;

class WatchedProfiles extends \common\models\WatchedProfiles
{
    public function fields(): array
    {
        return [
            'id',
            'status',
            'user_profile_id',
            'candidate_profile_id',
            'created_at',
            'updated_at'
        ];
    }

    public function extraFields(): array
    {
        return [];
    }
}
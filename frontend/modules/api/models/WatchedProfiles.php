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
            'updated_at',
            'mutual' => function () {
                return WatchedProfiles::find()->where([
                    'user_profile_id' => $this->candidate_profile_id,
                    'candidate_profile_id' => $this->user_profile_id,
                    'status' => $this::STATUS_LIKE])
                    ->exists();
            },
        ];
    }

    public function extraFields(): array
    {
        return [];
    }
}
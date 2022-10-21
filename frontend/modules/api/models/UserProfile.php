<?php

namespace frontend\modules\api\models;

class UserProfile extends \common\models\UserProfile
{
    public function fields(): array
    {
        return [
            'name',
            'gender',
            'city_id',
            'looking_for',
            'photo' => function () {
                return $this->getPhotoLink();
            },
            'birthday',
            'min_age',
            'max_age'
        ];
    }

    public function extraFields(): array
    {
        return [];
    }

    public function getPhotoLink()
    {
        if (empty($this->photo)) {
            return 'N/A';
        }
        return '/uploads/profile-photo/' . $this->photo;
    }
}
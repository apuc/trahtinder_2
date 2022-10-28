<?php

namespace frontend\modules\api\models;

class UserProfile extends \common\models\UserProfile
{
    public $age = 'TIMESTAMPDIFF(YEAR,birthday,curdate())';

    public function fields(): array
    {
        return [
            'id',
            'name',
            'gender',
            'city_id',
            'looking_for',
            'photo' => function () {
                return $this->getPhotoLink();
            },
            'birthday',
            'min_age',
            'max_age',
            'about'
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
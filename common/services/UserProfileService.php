<?php

namespace common\services;

use common\models\UserProfile;
use yii\db\ActiveQuery;

class UserProfileService
{
    public static function findCandidates($user_id): ActiveQuery
    {
        $userProfile = UserProfile::find()->where(['user_id' => $user_id])->one();

        $query = UserProfile::find()
            ->leftJoin('watched_profiles', 'user_profile.id = watched_profiles.candidate_profile_id')
            ->where(['watched_profiles.user_profile_id' => null]);

        if ($userProfile->orientation == UserProfile::ORIENTATION_HETERO && $userProfile->gender == UserProfile::GENDER_MAN) {
                $query->andWhere(['orientation' => UserProfile::ORIENTATION_HETERO, 'gender' => UserProfile::GENDER_WOMAN])
                ->orWhere(['orientation' => UserProfile::ORIENTATION_BISEXUAL, 'gender' => UserProfile::GENDER_WOMAN]);
        }
        else if ($userProfile->orientation == UserProfile::ORIENTATION_HETERO && $userProfile->gender == UserProfile::GENDER_WOMAN) {
            $query->andWhere(['orientation' => UserProfile::ORIENTATION_HETERO, 'gender' => UserProfile::GENDER_MAN])
                ->orWhere(['orientation' => UserProfile::ORIENTATION_BISEXUAL, 'gender' => UserProfile::GENDER_MAN]);
        }
        else if ($userProfile->orientation == UserProfile::ORIENTATION_GAY) {
            $query->andWhere(['orientation' => UserProfile::ORIENTATION_GAY])
                ->orWhere(['orientation' => UserProfile::ORIENTATION_BISEXUAL, 'gender' => UserProfile::GENDER_MAN]);
        }
        else if ($userProfile->orientation == UserProfile::ORIENTATION_LESBIAN) {
            $query->andWhere(['orientation' => UserProfile::ORIENTATION_LESBIAN])
                ->orWhere(['orientation' => UserProfile::ORIENTATION_BISEXUAL, 'gender' => UserProfile::GENDER_WOMAN]);
        }
        else { //  BISEXUAL
            if ($userProfile->gender == UserProfile::GENDER_WOMAN) {
                $query->andWhere(['orientation' => UserProfile::ORIENTATION_LESBIAN])
                    ->orWhere(['orientation' => UserProfile::ORIENTATION_BISEXUAL])
                    ->orWhere(['orientation' => UserProfile::ORIENTATION_HETERO, 'gender' => UserProfile::GENDER_MAN]);
            }
            else {
                $query->andWhere(['orientation' => UserProfile::ORIENTATION_GAY])
                    ->orWhere(['orientation' => UserProfile::ORIENTATION_BISEXUAL])
                    ->orWhere(['orientation' => UserProfile::ORIENTATION_HETERO, 'gender' => UserProfile::GENDER_WOMAN]);
            }
        }
        $query->andWhere(['!=', 'user_profile.id', $userProfile->id])
            ->andWhere(['<=', 'TIMESTAMPDIFF(YEAR,birthday,curdate())', $userProfile->max_age])
            ->andWhere(['>=', 'TIMESTAMPDIFF(YEAR,birthday,curdate())', $userProfile->min_age])
            ->andWhere(['user_profile.city_id' => $userProfile->city_id]);

        return $query;
    }
}
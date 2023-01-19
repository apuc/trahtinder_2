<?php

namespace console\controllers;

use common\models\City;
use common\models\User;
use common\models\UserProfile;
use Faker\Factory;
use Yii;
use yii\console\Controller;

/**
 * Hello controller
 */
class FakeUsersController extends Controller {

    public function actionGenerate($count)
    {
        $faker = Factory::create();
        $citiesId = City::find()->select('id')->indexBy('id')->column();
        $gendersList = [
            UserProfile::GENDER_WOMAN,
            UserProfile::GENDER_MAN
        ];
        $orientationForWoman = [
            UserProfile::ORIENTATION_HETERO,
            UserProfile::ORIENTATION_LESBIAN,
            UserProfile::ORIENTATION_BISEXUAL
        ];
        $orientationForMan = [
            UserProfile::ORIENTATION_GAY,
            UserProfile::ORIENTATION_HETERO,
            UserProfile::ORIENTATION_BISEXUAL
        ];

        foreach ($citiesId as $cityId) {
            echo "Generate users for city with id: $cityId \n";

            for($i = 0; $i < $count; $i++) {
                $user = new User();
                $user->status = User::STATUS_ACTIVE;
                $user->phone = $faker->phoneNumber;
                $user->password_hash = Yii::$app->security->generatePasswordHash('password');
                $user->auth_key = $faker->text(20);
                $user->email = $faker->email();
                $user->save(false);

                $profile = new UserProfile();
                $profile->gender = $gendersList[array_rand($gendersList)];
                $profile->about = $faker->text(rand(100, 200));
                $profile->user_id = $user->id;
                $profile->city_id = $cityId;
                $profile->min_age = rand(UserProfile::MIN_AGE, UserProfile::MAX_AGE - 5);
                $profile->max_age = rand($profile->min_age, UserProfile::MAX_AGE);
                $profile->orientation =
                    $profile->gender == UserProfile::GENDER_MAN ? $orientationForMan[array_rand($orientationForMan)] :
                        $orientationForWoman[array_rand($orientationForWoman)];
                $profile->birthday = $faker->date();
                $profile->name = $profile->gender == UserProfile::GENDER_MAN ? $faker->firstNameFemale: $faker->firstNameMale;
                $profile->save(false);

                echo "Save user: " . $profile->name . "\n";
            }
//            Yii::$app->db->createCommand()->batchInsert('user', [
//                'status',
//                'phone',
//                'password_hash',
//                'auth_key',
//                'email'
//            ], $userList)->execute();
//            Yii::$app->db->createCommand()->batchInsert('user', [
//                'gender',
//                'about',
//                'user_id',
//                'city_id',
//                'min_age',
//                'max_age',
//                'orientation',
//                'birthday',
//                'name',
//            ], $userList)->execute();

//            $userList = array();
//            $profileList = array();
        }
        unset($userList);
        unset($profileList);

        die('Data generation is complete!' . "\n");
    }
}
<?php

namespace frontend\modules\api\controllers;

use common\services\ResponseService;
use frontend\modules\api\models\WatchedProfiles;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;

class WatchedProfilesController extends ApiController
{
    public $modeClass = WatchedProfiles::class;

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    HttpBearerAuth::class,
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'viewed-profile' => ['post'],
                ],
            ]
        ]);
    }

    public function actionViewedProfile(): array
    {
        $watchedProfile = WatchedProfiles::find()->where([
            'user_profile_id' => \Yii::$app->request->post('user_profile_id'),
            'candidate_profile_id' => Yii::$app->request->post('candidate_profile_id')
        ])->one();

        if ($watchedProfile != null) {
            if ( $watchedProfile->load(Yii::$app->request->post(), '') && $watchedProfile->update() !== false) {
                $response = ResponseService::successResponse(
                    'Is updated!',
                    $watchedProfile
                );
            } else {
                Yii::$app->response->statusCode = 400;
                $response = ResponseService::errorResponse(
                    $watchedProfile->getErrors()
                );
            }
        } else {
            $watchedProfile = new WatchedProfiles();
            if ($watchedProfile->load(Yii::$app->request->post(), '') && $watchedProfile->save()) {
                $response = ResponseService::successResponse(
                    'Profile viewed!',
                    $watchedProfile
                );
            } else {
                Yii::$app->response->statusCode = 400;
                $response = ResponseService::errorResponse(
                    $watchedProfile->getErrors()
                );
            }
        }

        return $response;
    }

    public function actionDeleteView(): array
    {
        $watchedProfile = WatchedProfiles::find()->where([
            'user_profile_id' => \Yii::$app->request->post('user_profile_id'),
            'candidate_profile_id' => Yii::$app->request->post('candidate_profile_id')
        ])->one();

        if ($watchedProfile != null) {
            $watchedProfile->delete();

            $response = ResponseService::successResponse(
                'Success!',
                'View is deleted!'
            );
        } else {
            $response = ResponseService::errorResponse(
                'No match found!'
            );
        }

        return $response;
    }
}

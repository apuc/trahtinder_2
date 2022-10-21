<?php

namespace frontend\modules\api\controllers;


use common\services\ResponseService;
use frontend\modules\api\models\UserProfile;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class UserProfileController extends ApiController
{
    public $modeClass = UserProfile::class;

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
                    'create' => ['post'],
                    'profile' => ['get'],
                    'update' => ['post'],
                    'set-photo' => ['post'],
                ],
            ]
        ]);
    }

    public function actionProfile(): array
    {
        $response = ResponseService::successResponse(
            'Profile',
            UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one()
        );

        if (empty($response['data'])) {
            $response = ResponseService::errorResponse(
                'The profile not exist!'
            );
        }
        return $response;
    }

    public function actionCreate(): array
    {
        $userProfile = new UserProfile();
        $userProfile->user_id = Yii::$app->user->identity->id;

        if ($userProfile->load(Yii::$app->request->post(), '') && $userProfile->save()) {
            $response = ResponseService::successResponse(
                'Profile is created!',
                $userProfile
            );
        } else {
            Yii::$app->response->statusCode = 400;
            $response = ResponseService::errorResponse(
                $userProfile->getErrors()
            );
        }
        return $response;
    }

    public function actionUpdate(): array
    {
        $userProfile = UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

        if ($userProfile->load(Yii::$app->request->post(), '') && $userProfile->update()) {
            $response = ResponseService::successResponse(
                'Profile is updated!',
                $userProfile
            );

        } else {
            Yii::$app->response->statusCode = 400;
            $response = ResponseService::errorResponse(
                $userProfile->getErrors()
            );
        }

        return $response;
    }

    public function actionSetPhoto(): array
    {
        $userProfile = UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        $photo =  UploadedFile::getInstanceByName('photo');

        if(!empty($photo)){
            $imageName = md5(date("Y-m-d H:i:s"));
            $oldPhoto = empty($userProfile->photo) ? null : $userProfile->photo;
            $userProfile->photo = $imageName. '.' . $photo->getExtension();

            if ($userProfile->validate() && $userProfile->update()) {
                $path =  Yii::getAlias('@profilePhoto') . '/' . $imageName . '.' . $photo->getExtension();
                $photo->saveAs($path);

                if (!empty($oldPhoto)) {
                    @unlink(Yii::getAlias('@profilePhoto') . '/' . $oldPhoto);
                }

                return ResponseService::successResponse(
                    'Photo is set!',
                    $userProfile->getPhotoLink()
                );
            }
        }
        Yii::$app->response->statusCode = 400;
        return ResponseService::errorResponse(
            'Photo is empty'
        );
    }
}

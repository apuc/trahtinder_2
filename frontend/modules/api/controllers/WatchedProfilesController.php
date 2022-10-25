<?php

namespace frontend\modules\api\controllers;

use common\services\ResponseService;
use frontend\modules\api\models\UserProfile;
use frontend\modules\api\models\WatchedProfiles;
use Yii;
use yii\data\ActiveDataProvider;
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
                    'vie-profile' => ['post'],
                ],
            ]
        ]);
    }

    public function actionViewedProfile(): array
    {
        $watchedProfile = new WatchedProfiles();

        $colors = Yii::$app->request->post('colors');

        $ids = ArrayHelper::getColumn($colors, 'id');
        $savedColorIDs = ArrayHelper::getColumn(Color::find()->select(['id'])->all(), 'id');

        $deletedIds = array_diff($savedColorIDs, $ids);

        foreach ($deletedIds as $id){
            $model = Color::findOne($id);
            $model->delete();
        }


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
        return $response;
    }
}

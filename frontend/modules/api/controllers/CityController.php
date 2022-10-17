<?php

namespace frontend\modules\api\controllers;

use common\services\ResponseService;
use frontend\modules\api\models\City;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;

class CityController extends ApiController
{
    public $modeClass = City::class;

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
                    'city' => ['GET'],
                ],
            ]
        ]);
    }

    public function actionCity($city_id = null): array
    {
        if ($city_id) {
            $response = ResponseService::successResponse(
                'One city',
                City::find()
                    ->where(['id' => $city_id])
                    ->andWhere(['status' => City::STATUS_ACTIVE])
                    ->one()
            );
        } else {
            $response = ResponseService::successResponse(
                'Cities list',
                City::find()
                    ->where(['status' => City::STATUS_ACTIVE])
                    ->all()
            );
        }

        if (empty($response['data'])) {
            $response = ResponseService::errorResponse(
                'The cities not exist!'
            );
        }
        return $response;
    }
}

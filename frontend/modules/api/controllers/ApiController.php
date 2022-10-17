<?php

namespace frontend\modules\api\controllers;

use common\behaviors\GsCors;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\rest\Controller;

class ApiController extends Controller
{
    public function behaviors(): array
    {
        return [
            'corsFilter' => [
                'class' => GsCors::class,
                'cors' => [
                    'Origin' => ['*'],
                    //'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Allow-Headers' => [
                        'Content-Type',
                        'Access-Control-Allow-Headers',
                        'Authorization',
                        'X-Requested-With'
                    ],
                ]
            ],
            [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }
}
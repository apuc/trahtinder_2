<?php

namespace frontend\modules\api\controllers;

use common\services\ResponseService;
use frontend\modules\api\models\LoginForm;
use frontend\modules\api\models\PasswordResetRequestForm;
use frontend\modules\api\models\SignupForm;
use frontend\modules\api\models\User;
use Yii;

class UserController extends ApiController
{
    public $modeClass = User::class;

    public function behaviors() : array
    {
        $behaviors = parent::behaviors();

        $behaviors['verbs'] = [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'login' => ['GET'],
                    'create' => ['POST'],
                    'request-password-reset' => ['POST'],
                ],
            ];

        return $behaviors;
    }

    public function actionLogin($email, $password): array
    {
        $loginFormModel = new LoginForm();
        if ($loginFormModel->load(Yii::$app->request->get(), '') && $loginFormModel->login()) {
             $response = ResponseService::successResponse(
                'Authorization is successful!',
                User::findByEmail($loginFormModel->email)
            );
        } else {
            Yii::$app->response->statusCode = 400;
            $response = ResponseService::errorResponse(
                $loginFormModel->getErrors()
            );
        }
        return $response;
    }

    public function actionCreate(): array
    {
        $signupFormModel = new SignupForm();
        $signupFormModel->attributes = Yii::$app->request->post();

        if ($signupFormModel->signup()) {
            $response = ResponseService::successResponse(
                'You are now a member!',
                User::findByEmail($signupFormModel->email)
            );
        } else {
            Yii::$app->response->statusCode = 400;
            $response = ResponseService::errorResponse(
                $signupFormModel->getErrors()
            );
        }
        return $response;
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post(), '') & $model->validate()) {
            if ($model->sendEmail()) {
                return ResponseService::successResponse(
                    'Successful!',
                    'Check your email for further instructions.'
                );
            }
        }
        Yii::$app->response->statusCode = 400;
        return ResponseService::errorResponse(
            $model->getErrors()
        );
    }
}

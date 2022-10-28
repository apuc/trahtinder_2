<?php

namespace frontend\modules\api\controllers;


use common\services\ResponseService;
use common\services\UserProfileService;
use frontend\modules\api\models\UserProfile;
use frontend\modules\api\models\WatchedProfiles;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class UserProfileController extends ApiController
{
    public $modelClass = 'frontend\modules\api\models\UserProfile';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'candidateProfiles',
    ];

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
                    'candidates' => ['get'],
                    'joint' => ['get']
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

        if ($userProfile->load(Yii::$app->request->post(), '')) {
            if ($userProfile->update() !== false ) {
                $response = ResponseService::successResponse(
                    'Profile is updated!',
                    $userProfile
                );
            }
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

    public function actionCandidates(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => UserProfileService::findCandidates(Yii::$app->user->identity->id)
        ]);
    }

    public function actionJoint(int $status)
    {
        $userProfile = UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

//        $candidate_profile_id = WatchedProfiles::find()
//            ->select(['watched_profiles.candidate_profile_id']) //w_p.candidate_profile_id
//            ->innerJoin('watched_profiles as candidate_watch', 'candidate_watch.candidate_profile_id = ' . $userProfile->id)
//            ->where(['watched_profiles.status' => 'candidate_watch.status'])
//            ->andWhere(['watched_profiles.status' => $status])
//            ->andWhere(['candidate_watch.status' => $status])
//            ->andWhere(['watched_profiles.candidate_profile_id' => 'candidate_watch.user_profile_id'])
//            ->all();

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
                SELECT w_p.candidate_profile_id FROM watched_profiles w_p
                inner join watched_profiles cand_w_p on cand_w_p.candidate_profile_id = $userProfile->id
                where w_p.status = cand_w_p.status and w_p.status = $status and cand_w_p.status = $status
                and w_p.candidate_profile_id = cand_w_p.user_profile_id;");
        $candidateProfileIDArr = $command->queryAll();

        $candidateIdList = [];
        foreach ($candidateProfileIDArr as $profile_id) {
            $candidateIdList[] = $profile_id['candidate_profile_id'];
        }

        return new ActiveDataProvider([
            'query' => UserProfile::find()
                ->where(['in', 'id', $candidateIdList])
        ]);
    }
}

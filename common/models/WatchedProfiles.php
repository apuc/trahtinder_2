<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "watched_profiles".
 *
 * @property int $id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_profile_id
 * @property int $candidate_profile_id
 *
 * @property UserProfile $candidateProfile
 * @property UserProfile $userProfile
 */
class WatchedProfiles extends \yii\db\ActiveRecord
{
    const STATUS_LIKE = 10;
    const STATUS_STAR = 20;
    const STATUS_DISLIKE = 30;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'watched_profiles';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => time(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'user_profile_id', 'candidate_profile_id'], 'required'],
            [['status', 'created_at', 'updated_at', 'user_profile_id', 'candidate_profile_id'], 'integer'],
            ['user_profile_id', 'unique', 'targetAttribute' => ['user_profile_id', 'candidate_profile_id'], 'message'=>'Лайк уже поставлен'],
            [['candidate_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserProfile::class, 'targetAttribute' => ['candidate_profile_id' => 'id']],
            [['user_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserProfile::class, 'targetAttribute' => ['user_profile_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_profile_id' => 'User Profile ID',
            'candidate_profile_id' => 'Candidate Profile ID',
        ];
    }

    /**
     * Gets query for [[CandidateProfile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCandidateProfile()
    {
        return $this->hasOne(UserProfile::class, ['id' => 'candidate_profile_id']);
    }

    /**
     * Gets query for [[UserProfile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::class, ['id' => 'user_profile_id']);
    }
}

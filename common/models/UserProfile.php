<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "user_profile".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $gender
 * @property int|null $looking_for
 * @property string|null $photo
 * @property int $user_id
 * @property int $city_id
 *
 * @property City $city
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{
    public $image;

    const GENDER_WOMAN = 20;
    const GENDER_MAN = 30;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gender', 'looking_for', 'user_id', 'city_id'], 'integer'],
            [['gender', 'looking_for'], function ($attribute) {
                if (!in_array($this->$attribute, [self::GENDER_WOMAN, self::GENDER_MAN])) {
                    $this->addError($attribute, 'Invalid gender!');
                }
            }],
            [['user_id', 'city_id', 'gender', 'looking_for'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['photo'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            ['user_id', 'unique', 'message'=>'Профиль уже существует']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'gender' => 'Gender',
            'looking_for' => 'Looking For',
            'photo' => 'Photo',
            'user_id' => 'User ID',
            'city_id' => 'City ID',
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}

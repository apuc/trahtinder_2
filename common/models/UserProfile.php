<?php

namespace common\models;

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
 * @property string $birthday
 * @property string $created_at
 * @property string $updated_at
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
            [['user_id', 'city_id', 'gender', 'looking_for', 'birthday'], 'required'],
            [['birthday', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['photo'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            ['user_id', 'unique', 'message'=>'Профиль уже существует'],
            ['birthday', function ($attribute) {
                $diff = abs(strtotime($this->birthday) - strtotime(date('Y-m-d H:i:s')));
                $years = floor($diff / (365*60*60*24));

                if (18 > $years) {
                    $this->addError($attribute, "Sorry you're too young");
                }
                if (60 < $years) {
                    $this->addError($attribute, "Sorry you're too old");
                }
            }]
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
            'birthday' => 'Дата рождения',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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

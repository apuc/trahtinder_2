<?php

namespace frontend\modules\api\models;

use frontend\modules\api\models\User;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $password;
    public $email;
    public $rememberMe = true;

    private $_user;

    const EXPIRE_TIME_WEEK = 604800; // token expiration time, valid for 7 days
    const EXPIRE_TIME_MONTH = 2592000; // token expiration time, valid for 30 days


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect password.');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            if ($this->getUser()) {
                $access_token = $this->_user->generateAccessToken();
                $this->_user->access_token_expired_at = date('Y-m-d', time() + static::EXPIRE_TIME_WEEK);

                $this->_user->refresh_token = Yii::$app->security->generateRandomString();
                $this->_user->refresh_token_expired_at = date('Y-m-d', time() + static::EXPIRE_TIME_MONTH);

                $this->_user->save();
                Yii::$app->user->login($this->_user, static::EXPIRE_TIME_WEEK);
                return $access_token;
            }
        }
        return false;
    }

    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }
        return $this->_user;
    }
}

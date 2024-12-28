<?php

namespace app\models;

use app\models\User;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;

    private $_user;

    public function rules()
    {
        return [
            [['email', 'password'], 'safe'],
            [['email', 'password'], 'required'],
            ['email', 'email'],
            // ['password', 'validatePassword']
        ];
    }

    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            if ($user && Yii::$app->security->validatePassword($this->password, $user->password_hash)) {
                return Yii::$app->user->login($user);
            }
        }

        return false;
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user) {
                $this->addError($attribute, 'Неправильный email');
            }
        }
    }

    public function getUser()
    {
        if ($this->_user !== null) {
            $this->_user = User::findOne(['email' => $this->email]);
        }

        return $this->_user;
    }
}

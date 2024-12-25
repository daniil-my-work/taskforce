<?php

use app\models\User;
use yii\base\Module;

class LoginForm extends Module {
    public $email;
    public $password;

    private $_user;

    public function rules() {
        return [
            [['email', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword() {
        if (!$this->hasError()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('email', 'Неправильный email или пароль');
            }
        }
    }

    public function getUser() {
        if ($this->_user === null) {
            $this->_user = User::findOne(['email' => $this->email]);
        }

        return $this->_user;
    }
}
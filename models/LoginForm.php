<?php

namespace app\models;

use app\models\User;
use Yii;
use yii\base\Model;

// class LoginForm extends Module {
//     public $email;
//     public $password;

//     private $_user;

//     public function rules() {
//         return [
//             [['email', 'password'], 'required'],
//             ['password', 'validatePassword'],
//         ];
//     }

//     public function validatePassword() {
//         if (!$this->hasError()) {
//             $user = $this->getUser();

//             if (!$user || !$user->validatePassword($this->password)) {
//                 $this->addError('email', 'Неправильный email или пароль');
//             }
//         }
//     }

//     public function getUser() {
//         if ($this->_user === null) {
//             $this->_user = User::findOne(['email' => $this->email]);
//         }

//         return $this->_user;
//     }
// }

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
            // ['password', 'validatePassword']
        ];
    }

    public function getUser() {
        if($this->_user !== null) {
            $this->_user = User::findOne(['email' => $this->email]);
        }

        return $this->_user;
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

    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user) {
                $this->addError($attribute, 'Неправильный email');
            }
        }
    }
}

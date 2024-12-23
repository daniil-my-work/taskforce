<?php

namespace app\controllers;

use app\models\User;
use Exception;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionView($id)
    {
        $user = User::find()
            ->where(['id' => $id])
            ->one();

        if (!$user) {
            throw new \yii\web\NotFoundHttpException('Задача не найдена');
        }

        return $this->render('@app/views/site/user', ['user' => $user]);
    }
}

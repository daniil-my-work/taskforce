<?php

namespace app\controllers;

use app\models\User;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionView($id)
    {
        $user = User::find()
            ->where(['id' => $id])
            ->one();

        if (!$user) {
            throw new \yii\web\NotFoundHttpException('Пользователь не найден');
        }

        return $this->render('view', ['user' => $user]);
    }
}

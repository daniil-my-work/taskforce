<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\User;
use Yii;
use yii\web\Controller;

class HomeController extends Controller
{
    public function actionIndex()
    {
        $this->layout = 'landing';

        $loginForm = new LoginForm();
        $user = new User();

        if (Yii::$app->request->getIsPost()) {
            $loginForm->load(Yii::$app->request->post());

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($loginForm);
            }

            // Проверка и сохранение user_id
            if ($loginForm->validate()) {
                $user = $loginForm->getUser();

                if ($user) {
                    Yii::$app->user->login($user); 

                    // $userId = $user->id; // Получаем ID пользователя
                    // Yii::$app->session->set('user_id', $userId); // Сохраняем user_id в сессии
                    return $this->redirect(['user/view', 'id' => $user->id]); // Редирект с ID
                } else {
                    throw new \yii\web\NotFoundHttpException('Пользователь не найден.');
                }
            }
        }

        return $this->render('index');
    }
}

<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class LogOutController extends Controller
{
    /**
     * Displays homepage.
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->user->logout();
        return $this->goHome();
        
        // Yii::$app->user->logout(); // Завершаем сессию пользователя
        // Yii::$app->session->removeAll(); // Удаляем все данные из сессии (опционально)
        // return $this->redirect(['auth/index']); 
        // return $this->redirect(['auth/index']);
    }
}

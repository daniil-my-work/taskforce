<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    /**
     * Displays homepage.
     * @return string
     */
    public function actionIndex()
    {
        $model = new User();

        if (Yii::$app->request->getIsPost()) {
            $model->load(Yii::$app->request->post());

            if ($model->validate()) {
                $model->save();

                var_dump('Валидация прошла');
                return $this->redirect(['/']);
            }
        }

        return $this->render('index', ['model' => $model]);
    }
}

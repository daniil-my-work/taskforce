<?php

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    // public function init()
    // {
    //     parent::init();
    //     $this->layout = 'main'; // Укажите layouts/main.php
    // }

    /**
     * Displays homepage.
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTest()
    {
        $response = file_get_contents('https://randomuser.me/api/');
        $data = json_decode($response, true);
        var_dump($data['results']);

        // return 'Тест';
    }
}

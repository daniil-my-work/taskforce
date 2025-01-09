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

    public function actionAuth()
    {
        return $this->render('index');
    }
}

<?php

namespace app\controllers;

use yii\web\Controller;

class HomeController extends Controller
{
    // public function init()
    // {
    //     parent::init();
    //     $this->layout = 'landing'; // Укажите layouts/landing.php
    // }

    public function actionIndex()
    {
        $this->layout = 'landing';

        return $this->render('index');
    }
}

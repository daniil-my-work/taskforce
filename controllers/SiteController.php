<?php

namespace app\controllers;

use yii\web\Controller;
use GuzzleHttp\Client;

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
        // Вариант 1
        // // Инициализация cURL
        // $ch = curl_init('https://randomuser.me/api/');
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Возвращать результат в виде строки
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Следовать за редиректами
        // // Выполнение запроса
        // $result = curl_exec($ch);
        // // Проверка на ошибки
        // if ($result === false) {
        //     echo "Ошибка cURL: " . curl_error($ch);
        // } else {
        //     // Преобразуем JSON-ответ в массив
        //     $data = json_decode($result, true);

        //     // Выводим результат
        //     echo "<pre>";
        //     print_r($data);
        //     echo "</pre>";
        // }
        // curl_close($ch);

        // $client = new Client();
        // try {
        //     $response = $client->request('GET', 'https://randomuser.me/api/', [
        //         'headers' => [
        //             'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
        //         ]
        //     ]);

        //     $result = $response->getBody()->getContents();
        //     $data = json_decode($result, true);
        //     echo "<pre>";
        //     print_r($data);
        //     echo "</pre>";
        // } catch (\GuzzleHttp\Exception\RequestException $e) {
        //     echo "Ошибка запроса: " . $e->getMessage();
        // }
    }
}

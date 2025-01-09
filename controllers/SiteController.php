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

        // Вариант 2
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



        // // === Запрос к апи серверу ===
        // $client = new Client([
        //     'base_uri' => 'https://jsonplaceholder.typicode.com/',
        //     'timeout'  => 5.0,
        // ]);

        // try {
        //     $response = $client->request('GET', 'posts/2');
        //     $result = $response->getBody()->getContents();

        //     $data = json_decode($result, true);
        //     echo "<pre>";
        //     print_r($data);
        //     echo "</pre>";
        // } catch (\GuzzleHttp\Exception\RequestException $e) {
        //     echo "Ошибка запроса: " . $e->getMessage();
        // }

        // === Запрос к апи по ключу ===
        // $apiKey = 'ваш_апи_ключ'; // Замените на ваш API-ключ
        // $city = 'London';

        // $client = new Client([
        //     'base_uri' => 'https://api.openweathermap.org/data/2.5/',
        //     'timeout' => 5.0
        // ]);

        // try {
        //     $response = $client->request('GET', 'weather', [
        //         'query' => [
        //             'q' => $city,
        //             'appid' => $apiKey,
        //             'units' => 'metric',
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





        // Задание 1
        // 1. https://jsonplaceholder.typicode.com/
        // $client = new Client([
        //     'base_uri' => 'https://jsonplaceholder.typicode.com/',
        //     'timeout' => 5.0
        // ]);

        // $response = $client->request("GET", "posts/3");
        // $result = $response->getBody()->getContents();
        // $data = json_decode($result, true);

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        // Задание 2
        // 2. https://api.openweathermap.org/data/2.5/
        // $apiKey = '1234key';
        // $city = 'London';

        // $client = new Client([
        //     'base_uri' => 'https://api.openweathermap.org/data/2.5/',
        //     'timeout' => 5.0,
        // ]);

        // $response = $client->request("GET", 'weather', [
        //     'query' => [
        //         'q' => $city,
        //         'appid' => $apiKey,
        //         'units' => 'metric', // Опционально: единицы измерения (метрические)
        //     ],
        // ]);

        // $result = $response->getBody()->getContents();
        // $data = json_decode($result, true);

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        // Задание 3
        // $ch = curl_init('https://api.openweathermap.org/data/2.5/weather');

        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // $result = curl_exec($ch);
        // curl_close($ch);

        // $data = json_decode($result, true);
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";


        // $url = 'https://api.openweathermap.org/data/2.5/weather?';
        // $apiKey = 'ваш_апи_ключ'; // Замените на ваш API-ключ
        // $city = 'London'; // Город
        // $units = 'metric'; // Единицы измерения: 'metric' для Цельсия

        // $options = [
        //     'q' => $city,
        //     'appid' => $apiKey,
        //     'units' => $units
        // ];

        // $apiUrl = $url . http_build_query($options);

        // $ch = curl_init($apiUrl);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // $result = curl_exec($ch);

        // if ($result === false) {
        //     echo 'Ошибка' . curl_error($ch);
        // } else {
        //     $data = json_decode($result, true);
        //     echo "<pre>";
        //     print_r($data);
        //     echo "</pre>";
        // }


        // $apiKey = 'ваш_апи_ключ'; // Замените на ваш API-ключ
        // $city = 'London'; // Город
        // $units = 'metric'; // Единицы измерения: 'metric' для Цельсия

        // $client = new Client([
        //     'base_uri' => 'https://api.openweathermap.org/data/2.5/weather',
        //     'timeout' => 5.0
        // ]);

        // $response = $client->request('GET', 'weather', [
        //     'query' => [
        //         'q' => $city,
        //         'appid' => $apiKey,
        //         'units' => $units,
        //     ]
        // ]);

        // $result = $response->getBody()->getContents();
        // $data = json_decode($result, true);

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
    }
}

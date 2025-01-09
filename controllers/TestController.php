<?php

namespace app\controllers;

use Exception;
use yii\web\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use Yii;
use yii\helpers\ArrayHelper;

class TestController extends Controller
{
    public function actionIndex()
    {
        return '';

        $email = Yii::$app->request->get('email', 'dannil.suvorov.97@bk.ru');
        $api_key = '123';

        $client = new Client([
            'base_uri' => 'https://apilayer.net/api/',
        ]);

        try {
            $request = new Request('GET', 'check');
            $response = $client->send($request, [
                'query' => ['email' => $email, 'access_key' => $api_key]
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new BadResponseException("Response error: " . $response->getReasonPhrase(), $request);
            }

            $content = $response->getBody()->getContents();
            $response_data = json_decode($content, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new ServerException("Invalid json format", $request);
            }

            if ($error = ArrayHelper::getValue($response_data, 'error.info')) {
                throw new BadResponseException("API error: " . $error, $request);
            }

            $result = false;

            if (is_array($response_data)) {
                $result = !empty($response_data['mx_found']) && !empty($response_data['smtp_check']);
            }
        } catch (RequestException $e) {
            $result = true;
        }

        var_dump("Результат проверки $email", $result);
        // var_dump($client);
        // var_dump($response);
    }

    public function getCoordinates($address)
    {
        $apiKey = 'd8091d3d-52a0-4421-bed1-e87af343c573'; // Замените на ваш API-ключ Яндекса
        $baseUrl = 'https://geocode-maps.yandex.ru/1.x/';

        // Параметры запроса
        $params = [
            'apikey' => $apiKey,
            'geocode' => $address,
            'format' => 'json'
        ];

        // Формируем URL с параметрами
        $url = $baseUrl . '?' . http_build_query($params);

        // Инициализация cURL
        $ch = curl_init($url);

        // Настройки cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Возвращать результат в виде строки
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Отключить проверку SSL-сертификата

        // Выполняем запрос
        $response = curl_exec($ch);

        // Проверяем ошибки
        if (curl_errno($ch)) {
            throw new Exception('Ошибка cURL: ' . curl_error($ch));
        }

        // Проверяем HTTP-статус
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode !== 200) {
            throw new Exception("HTTP ошибка: $httpCode");
        }

        // Закрываем cURL
        curl_close($ch);

        // Разбираем JSON-ответ
        $data = json_decode($response, true);

        if (isset($data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'])) {
            $coordinates = $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
            return explode(' ', $coordinates);
        } else {
            throw new Exception('Координаты не найдены.');
        }
    }

    public function actionMap()
    {
        // Пример использования
        try {
            // Получаем адрес из параметра в URL
            $address = $_GET['address'] ?? 'Москва, Красная площадь';
            // address=Москва, Щелковское шоссе 61

            // Получаем координаты
            $coordinates = $this->getCoordinates($address);
            echo "Широта: {$coordinates[1]}, Долгота: {$coordinates[0]}";

            return $this->render('map');
        } catch (Exception $e) {
            echo 'Ошибка: ' . $e->getMessage();
        }
    }
}

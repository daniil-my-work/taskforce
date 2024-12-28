<?php

namespace app\controllers;

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
}

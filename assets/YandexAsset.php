<?php

namespace app\assets;
use yii\web\AssetBundle;

class YandexAsset extends AssetBundle {
    public $sourcePath = null;

    public function init() {
        parent::init();

        $api_key = 'e666f398-c983-4bde-8f14-e3fec900592a';
        $this->js[] = "https://api-maps.yandex.ru/2.1/?apikey=$api_key&lang=ru_RU";
    }
}

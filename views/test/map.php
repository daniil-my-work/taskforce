<?php

use app\assets\YandexAsset;
use yii\authclient\widgets\AuthChoice;
use yii\web\View;

YandexAsset::register($this);
?>

<div>
    <div id="map" style="width: 600px; height: 400px"></div>
</div>

<?php
AuthChoice::widget([
    'baseAuthUrl' => ['site/auth'],
    'popupMode' => false
]);
?>

<?php
$this->registerJs(<<<JS
   ymaps.ready(init);

   function init() {
       // Создание карты.
       var myMap = new ymaps.Map("map", {
           // Координаты центра карты.
           // Порядок по умолчанию: «широта, долгота».
           // Чтобы не определять координаты центра карты вручную,
           // воспользуйтесь инструментом Определение координат.
           center: [55.76, 37.64],
           // Уровень масштабирования. Допустимые значения:
           // от 0 (весь мир) до 19.
           zoom: 7
       });

       myMap.controls.remove('trafficControl');
       myMap.controls.remove('searchControl');
       myMap.controls.remove('geolocationControl');
       myMap.controls.remove('typeSelector');
       myMap.controls.remove('fullScreenControl');
       myMap.controls.remove('rulerControl');
   }
JS, View::POS_READY);
?>
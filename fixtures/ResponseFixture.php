<?php

namespace app\fixtures;

use yii\test\ActiveFixture;

class ResponseFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Response';  // Модель, для которой загружаются данные
    public $dataFile = '@app/fixtures/data/response.php'; 
}


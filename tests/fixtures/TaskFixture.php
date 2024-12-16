<?php

namespace app\tests\fixtures;

use yii\test\ActiveFixture;

class TaskFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Task';  // Модель, для которой загружаются данные
    public $dataFile = '@app/tests/fixtures/data/task.php';  // Путь к данным
}


<?php

namespace app\fixtures;

use yii\test\ActiveFixture;

class PublisherFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Publisher';
    public $dataFile = '@app/fixtures/data/publisher.php';
}

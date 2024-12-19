<?php

namespace app\fixtures;

use yii\test\ActiveFixture;

class BookPublisherFixture extends ActiveFixture
{
    public $modelClass = 'app\models\BookPublisher';
    public $dataFile = '@app/fixtures/data/book_publisher.php';
}

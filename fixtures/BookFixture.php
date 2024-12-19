<?php

namespace app\fixtures;

use yii\test\ActiveFixture;

class BookFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Book';
    public $dataFile = '@app/fixtures/data/book.php';
}

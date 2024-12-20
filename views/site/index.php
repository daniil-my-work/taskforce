<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'My Yii Application';

// Генерация URL
echo Url::to(['post/view', 'id' => 123]);
?>
<div class="main-container">
    <p>
        Hello world !

        
    </p>
</div>
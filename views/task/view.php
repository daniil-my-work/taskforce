<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="left-column">
    <div class="head-wrapper">
        <h3 class="head-main">
            <?= Html::encode($task->title); ?>
        </h3>
        <p class="price price--big">
            <?= Html::encode($task->budget); ?>
            ₽
        </p>
    </div>
    <p class="task-description">
        <?= Html::encode($task->task_description); ?>
    </p>

    <a href="#" class="button button--blue action-btn" data-action="act_response">Откликнуться на задание</a>
    <a href="#" class="button button--orange action-btn" data-action="refusal">Отказаться от задания</a>
    <a href="#" class="button button--pink action-btn" data-action="completion">Завершить задание</a>

    <div class="task-map">
        <img class="map" src="img/map.png" width="725" height="346" alt="Новый арбат, 23, к. 1">
        <p class="map-address town">
            <?= Html::encode($task->cities ? $task->cities->city_name : 'Не определен'); ?>
        </p>
        <p class="map-address">Новый арбат, 23, к. 1</p>
    </div>

    <h4 class="head-regular">Отклики на задание</h4>
    <?php foreach ($task->response as $response): ?>
        <div class="response-card">
            <img class="customer-photo" src="img/man-glasses.png" width="146" height="156" alt="Фото заказчиков">
            <div class="feedback-wrapper">
                <a href="#" class="link link--block link--big">
                    <?= $response->performer; ?>
                </a>
                <div class="response-wrapper">
                    <div class="stars-rating small"><span class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span>&nbsp;</span></div>
                    <p class="reviews">2 отзыва</p>
                </div>
                <p class="response-message">
                    <?= $response->response_description; ?>
                </p>
            </div>
            <div class="feedback-wrapper">
                <p class="info-text">
                    <span class="current-time">
                        <?= $response->date_response; ?>
                    </span>
                </p>
                <p class="price price--small">
                    <?= $response->price; ?>
                    ₽
                </p>
            </div>
            <div class="button-popup">
                <a href="#" class="button button--blue button--small">Принять</a>
                <a href="#" class="button button--orange button--small">Отказать</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="right-column">
    <div class="right-card black info-card">
        <h4 class="head-card">Информация о задании</h4>
        <dl class="black-list">
            <dt>Категория</dt>
            <dd>
                <?= Html::encode($task->category->name_category); ?>
            </dd>
            <dt>Дата публикации</dt>
            <dd>
                <?php
                // Преобразуем дату публикации в метку времени Unix, если она в формате строки
                $datePublic = strtotime($task->date_public);

                // Вычисляем разницу между текущим временем и временем публикации
                $timeDifference = time() - $datePublic;

                // Получаем дату в формате "H:i:s" (часы:минуты:секунды)
                $formattedTime = date('H:i:s', $timeDifference);

                echo Html::encode($formattedTime);
                ?>
            </dd>
            <dt>Срок выполнения</dt>
            <dd>
                <?= Html::encode($task->date_finish); ?>
            </dd>
            <dt>Статус</dt>
            <dd>
                <?= Html::encode($task->task_status); ?>
            </dd>
        </dl>
    </div>
    <div class="right-card white file-card">
        <h4 class="head-card">Файлы задания</h4>
        <ul class="enumeration-list">
            <li class="enumeration-item">
                <a href="#" class="link link--block link--clip">my_picture.jpg</a>
                <p class="file-size">356 Кб</p>
            </li>
            <li class="enumeration-item">
                <a href="#" class="link link--block link--clip">information.docx</a>
                <p class="file-size">12 Кб</p>
            </li>
        </ul>
    </div>
</div>
<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="left-column">
    <h3 class="head-main head-task">Новые задания</h3>

    <?php foreach ($tasks as $task): ?>
        <div class="task-card">
            <div class="header-task">
                <a href="#" class="link link--block link--big">
                    <?= Html::encode($task->title); ?>
                </a>
                <p class="price price--task">
                    <?= $task->budget; ?>
                </p>
            </div>
            <p class="info-text">
                <span class="current-time">
                    <?= Yii::$app->formatter->asRelativeTime($task->date_public); ?>
                </span>
            </p>
            <p class="task-text">
                <?= $task->task_description; ?>
            </p>
            <div class="footer-task">
                <p class="info-text town-text">
                    <?= $task->cities->city_name; ?>
                </p>
                <p class="info-text category-text">
                    <!-- Не выводит -->
                    <?= $task->category->name_category; ?>
                </p>
                <a href="<?= 'task-list/view/' . $task->id; ?>" class="button button--black">Смотреть Задание</a>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="pagination-wrapper">
        <ul class="pagination-list">
            <li class="pagination-item mark">
                <a href="#" class="link link--page"></a>
            </li>
            <li class="pagination-item">
                <a href="#" class="link link--page">1</a>
            </li>
            <li class="pagination-item pagination-item--active">
                <a href="#" class="link link--page">2</a>
            </li>
            <li class="pagination-item">
                <a href="#" class="link link--page">3</a>
            </li>
            <li class="pagination-item mark">
                <a href="#" class="link link--page"></a>
            </li>
        </ul>
    </div>
</div>
<div class="right-column">
    <div class="right-card black">
        <div class="search-form">
            <?php $form = ActiveForm::begin(); ?>

            <h4 class="head-card">Категории</h4>
            <div class="form-group">
                <div class="checkbox-wrapper">
                    <?= $form->field($model, 'name_category')->checkboxList(
                        $categories,
                        ['value' => $model->name_category]
                    )->label(false); ?>
                </div>
            </div>

            <h4 class="head-card">Дополнительно</h4>
            <div class="form-group">
                <?= $form->field($model, 'without_performer')->checkbox(
                    ['label' => 'Без исполнителя'],
                    ['checked' => $model->without_performer]
                )->label(false); ?>
            </div>

            <h4 class="head-card">Период</h4>
            <div class="form-group">
                <?= $form->field($model, 'period_value')->dropDownList(
                    [
                        '1' => '1 час',
                        '12' => '12 часов',
                        '24' => '24 часа',
                    ],
                    ['prompt' => 'Выберите период', 'value' => $model->period_value]
                )->label(false); ?>
            </div>

            <?= Html::submitButton('Искать', ['class' => 'button button--blue']); ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
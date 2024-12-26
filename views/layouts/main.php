<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="">
    <?php $this->beginBody() ?>
    <header class="page-header">
        <?php if (Yii::$app->controller->id !== 'auth') : ?>
            <nav class="main-nav">
                <a href='<?= Url::to(['/']); ?>' class="header-logo">
                    <img class="logo-image" src="img/logotype.png" width=227 height=60 alt="taskforce">
                </a>
                <div class="nav-wrapper">
                    <ul class="nav-list">
                        <li class="list-item list-item--active">
                            <a class="link link--nav">Новое</a>
                        </li>
                        <?=

                        Nav::widget([
                            'items' => [
                                // ['label' => 'Главная', 'url' => ['/site/index']],
                                ['label' => 'Мои задания', 'url' => ['/task/view']], 
                                ['label' => 'Создать задание', 'url' => ['task/add'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'Заказчик'], // Показать только для "Заказчика"
                                ['label' => 'Выход', 'url' => ['log-out/index']],
                            ],
                        ]);
                        ?>
                       
                    </ul>
                </div>
            </nav>
        <?php endif; ?>
        <?php if (Yii::$app->controller->id !== 'auth') : ?>

            <?php
            if (Yii::$app->user->isGuest) {
                $userName = '';
            } else {
                $user = Yii::$app->user->identity;
                $userName = $user->user_name ?? '';
            }
            ?>
            <div class="user-block">
                <a href="#">
                    <img class="user-photo" src="img/man-glasses.png" width="55" height="55" alt="Аватар">
                </a>
                <div class="user-menu">
                    <p class="user-name">
                        <?= $userName; ?>
                    </p>
                    <div class="popup-head">
                        <ul class="popup-menu">
                            <li class="menu-item">
                                <a href="#" class="link">Настройки</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="link">Связаться с нами</a>
                            </li>
                            <li class="menu-item">
                                <a href="<?= Url::to(['log-out/index']); ?>" class="link">Выход из системы</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </header>

    <main class="main-content main-content--center container">
        <?= $content; ?>
    </main>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
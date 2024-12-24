<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>
<style>
    .main-content {
        flex-direction: column;
    }
</style>

<div class="center-block">
    <div class="registration-form regular-form">
        <?php $form = ActiveForm::begin(); ?>

        <h3 class="head-main head-task">Регистрация нового пользователя</h3>
        <div class="form-group">
            <?= $form->field($model, 'user_name')->textInput(); ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'email')->input('email'); ?>
            <span class="help-block">Error description is here</span>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'city')->dropDownList([
                '1' => 'Москва',
                '2' => 'Санкт-Петербург',
                '3' => 'Владивосток',
            ]); ?>
            <span class="help-block">Error description is here</span>
        </div>

        <div class="half-wrapper">
            <div class="form-group">
                <?= $form->field($model, 'user_password')->passwordInput(); ?>
                <span class="help-block">Error description is here</span>
            </div>
        </div>

        <div class="half-wrapper">
            <div class="form-group">
                <?= $form->field($model, 'password_repeat_user')->passwordInput(); ?>
                <span class="help-block">Error description is here</span>
            </div>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'is_active')->checkbox([
                'label' => 'я собираюсь откликаться на заказы'
            ]); ?>
        </div>

        <?= Html::submitButton('Создать аккаунт', ['class' => 'button button--blue']); ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>
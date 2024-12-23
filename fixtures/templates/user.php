<?php


return [
    'date_registration' => $faker->date(), // генерирует дату
    'user_name' => $faker->name(), // генерирует имя
    'email' => $faker->email(), // генерирует email
    'user_password' => '12', // генерирует пароль
    'city' => $faker->city(), // генерирует город
    'user_role' => $faker->randomElement(['admin', 'user', 'super']), // случайная роль
    'is_available' => $faker->boolean(), // генерирует случайное булево значение (true/false)
];

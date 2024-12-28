<?php

/* @var $faker \Faker\Generator */

return [
    'task_status_code' => 'new',
    'task_status' => 'new',
    'title' => $faker->sentence(6),
    'task_description' => $faker->paragraph(3),
    'task_file' => $faker->filePath(),
    'budget' => $faker->numberBetween(1000, 100000),
    'city' => $faker->numberBetween(1088, 1090),
    'city_lon' => $faker->longitude,
    'city_lat' => $faker->latitude,
    'date_finish' => $faker->dateTimeBetween('+1 week', '+1 month')->format('Y-m-d H:i:s'),
    'category_id' => $faker->numberBetween(9, 16),
    'client_id' => $faker->numberBetween(1, 14),
    'performer_id' => $faker->numberBetween(1, 4),
];

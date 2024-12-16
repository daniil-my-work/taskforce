<?php

/* @var $faker \Faker\Generator */

return [
    'task_status_code' => $faker->unique()->randomElement(['new', 'in_progress', 'completed', 'cancelled']),
    'task_status' => $faker->randomElement(['New', 'In Progress', 'Completed', 'Cancelled']),
    'title' => $faker->sentence(6),
    'task_description' => $faker->paragraph(3),
    'task_file' => $faker->filePath(),
    'budget' => $faker->numberBetween(1000, 100000),
    'city' => $faker->city,
    'city_lon' => $faker->longitude,
    'city_lat' => $faker->latitude,
    'date_finish' => $faker->dateTimeBetween('+1 week', '+1 month')->format('Y-m-d H:i:s'),
    'category_id' => $faker->numberBetween(1, 10),
    'client_id' => $faker->numberBetween(1, 100),
    'performer_id' => $faker->numberBetween(1, 100),
];

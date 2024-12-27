<?php

/* @var $faker \Faker\Generator */

return [
    'date_response' => date('Y-m-d H:i:s'),
    'response_description' => $faker->sentence(30),
    'price' => $faker->numberBetween(0, 1000),
    'performer' => $faker->numberBetween(1, 4),
    'response_mark' => $faker->numberBetween(0, 10),
];

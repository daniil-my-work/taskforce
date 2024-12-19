<?php

namespace app\fixtures\templates;

/* @var $faker \Faker\Generator */

return [
    'book_id' => $faker->numberBetween(1, 15),
    'publisher_id' => $faker->numberBetween(1, 10),
];

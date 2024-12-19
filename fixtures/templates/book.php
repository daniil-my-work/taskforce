<?php

namespace app\fixtures\templates;

/* @var $faker \Faker\Generator */

return [
    'title' => $faker->sentence(10),
    'author' => $faker->name(),
    'published_year' => $faker->year(),
    'genre' => $faker->randomElement(["Фантастика", "Детектив", "Роман", "Поэзия"]),
    // 'created_at' => $faker->dateTimeThisDecade()->getTimestamp(),
    // 'updated_at' => $faker->dateTimeThisDecade()->getTimestamp(),
];

<?php

declare(strict_types=1);
ini_set('assert.exception', 1);

require_once __DIR__ . '/vendor/autoload.php';

use php2\classes\converter\CsvConverter;
use php2\classes\converter\CsvDirectoryConverter;
use php2\classes\inter\Circle;
use php2\classes\inter\Rectangle;
use php2\classes\logic\action\ResponseTaskAction;
use php2\classes\logic\AvailableActions;


// try {
//     $strategy = new AvailableActions(AvailableActions::STATUS_NEW, 3, 1);

//     $nextStatus = $strategy->getNextStatus(new ResponseTaskAction());
// } catch (Exception $e) {
//     echo "Ошибка: " . $e->getMessage();
//     die();
// }


// var_dump('new -> performer, alien', $strategy->getAvailableActions(AvailableActions::ROLE_PERFORMER, 2));
// var_dump('new -> customer, alien', $strategy->getAvailableActions(AvailableActions::ROLE_CUSTOMER, 2));

// var_dump('new -> customer, same', $strategy->getAvailableActions(AvailableActions::ROLE_CUSTOMER, 3));
// var_dump('new -> performer, same', $strategy->getAvailableActions(AvailableActions::ROLE_PERFORMER, 1));



// try {
//     // $inputFilePath = __DIR__ . "/init/data/csv/cities.csv";
//     // $outputFilePath = __DIR__ . "/init/output/sql/cities.sql";
//     // $columns = ['city_name', 'city_lon', 'city_lat'];

//     $inputFilePath = __DIR__ . "/init/data/csv/categories.csv";
//     $outputFilePath = __DIR__ . "/init/output/sql/categories.sql";
//     $columns = ['name_category', 'character_code'];

//     $converter = new CsvConverter($inputFilePath, $outputFilePath, $columns);
//     $result = $converter->convert();

//     echo "SQL успешно создан: {$outputFilePath}";
// } catch (Exception $e) {
//     echo "Ошибка: " . $e->getMessage();
//     die();
// }



// try {
//     $converter = new CsvDirectoryConverter('init/data/csv');
//     $result = $converter->convertFiles('init/data/sql');
//     var_dump($result);
    
//     // $converter->getFiles();
// } catch (Exception $e) {
//     echo "Ошибка: " . $e->getMessage();
//     die();
// }


$number = rand(0, 1);
$class = $number === 1 ? Circle::class : Rectangle::class;
$obj = new $class();

// Вывод результата
echo "Класс: " . get_class($obj) . PHP_EOL;
echo "Площадь: " . $obj->getArea() . PHP_EOL;

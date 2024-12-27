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

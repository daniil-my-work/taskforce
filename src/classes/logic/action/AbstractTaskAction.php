<?php

namespace php2\classes\logic\action;

abstract class AbstractTaskAction
{
    abstract public static function getValue(): string;

    abstract public static function getName(): string;

    abstract public static function checkRights(?int $customerId, ?int $performerId, int $userId): bool;
}

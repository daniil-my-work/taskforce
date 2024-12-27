<?php

namespace app\src\classes\logic\action;

use app\src\classes\logic\action\AbstractTaskAction;

class DenyTaskAction extends AbstractTaskAction
{
    const ACTION_DENY = 'act_deny';

    public static function getValue(): string
    {
        return self::ACTION_DENY;
    }

    public static function getName(): string
    {
        return "Отказаться";
    }

    public static function checkRights(?int $customerId, ?int $performerId, int $userId): bool
    {
        return $performerId == $userId;
    }
}

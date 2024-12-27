<?php

namespace app\src\classes\logic\action;

use app\src\classes\logic\action\AbstractTaskAction;

class CancelTaskAction extends AbstractTaskAction
{
    const ACTION_CANCEL = 'act_cancel';

    public static function getValue(): string
    {
        return self::ACTION_CANCEL;
    }

    public static function getName(): string
    {
        return "Отменить";
    }

    public static function checkRights(?int $customerId, ?int $performerId, int $userId): bool
    {
        return $customerId == $userId;
    }
}

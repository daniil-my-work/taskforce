<?php

namespace php2\classes\logic\action;

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

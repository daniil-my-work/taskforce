<?php

namespace php2\classes\logic\action;

class CompleteTaskAction extends AbstractTaskAction
{
    const ACTION_COMPLETE = 'act_complete';

    public static function getValue(): string
    {
        return self::ACTION_COMPLETE;
    }

    public static function getName(): string
    {
        return "Выполнено";
    }

    public static function checkRights(?int $customerId, ?int $performerId, int $userId): bool
    {
        return $customerId == $userId;
    }
}

<?php

namespace php2\classes\logic\action;

class ResponseTaskAction extends AbstractTaskAction
{
    const ACTION_RESPONSE = 'act_response';

    public static function getValue(): string
    {
        return self::ACTION_RESPONSE;
    }

    public static function getName(): string
    {
        return "Откликнуться";
    }

    public static function checkRights(?int $customerId, ?int $performerId, int $userId): bool
    {
        return $performerId == $userId;
    }
}

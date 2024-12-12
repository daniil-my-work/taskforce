<?php
namespace php2\classes\logic;

use php2\classes\exception\RoleActionException;
use php2\classes\exception\StatusActionException;
use php2\classes\logic\action\AbstractTaskAction;
use php2\classes\logic\action\CancelTaskAction;
use php2\classes\logic\action\CompleteTaskAction;
use php2\classes\logic\action\DenyTaskAction;
use php2\classes\logic\action\ResponseTaskAction;

class AvailableActions
{
    // Доступные статусы задания
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'proceed';
    const STATUS_CANCEL = 'cancel';
    const STATUS_COMPLETE = 'complete';
    const STATUS_EXPIRED = 'expired';

    // Роли пользователей
    const ROLE_PERFORMER = 'performer';
    const ROLE_CUSTOMER = 'customer';

    // Текущий статус задания
    private ?string $currentStatus;

    // ID заказчика и исполнителя
    private int $customerId;
    private ?int $performerId;

    /**
     * AvailableActions __constructor
     * @param string status
     * @param int customerId
     * @param ?int performerId
     */
    public function __construct(string $status, int $customerId, ?int $performerId = null)
    {
        $this->setStatus($status);

        $this->customerId = $customerId;
        $this->performerId = $performerId;
    }

    /**
     * Получает доступные действия в зависимости от роли и статуса задачи.
     * 
     * @param string $role Роль пользователя.
     * @param int $id Идентификатор пользователя.
     * @return AbstractTaskAction[] Список доступных действий.
     */
    public function getAvailableActions(string $role, int $id): array
    {
        $statusActions = $this->statusAllowedActions($this->currentStatus);
        $roleActions = $this->roleAllowedActions($role);

        $allowedActions = array_intersect($statusActions, $roleActions);

        $allowedActions = array_filter($allowedActions, function ($action) use ($id) {
            return $action::checkRights($this->customerId, $this->performerId, $id);
        });

        return array_values($allowedActions);
    }


    public function getStatusMap(): array
    {
        return [
            self::STATUS_NEW => "Новое",
            self::STATUS_CANCEL => "Отменено",
            self::STATUS_IN_PROGRESS => "В работе",
            self::STATUS_COMPLETE => "Выполнено",
            self::STATUS_EXPIRED => "Провалено",
        ];
    }

    public function getActionsMap(): array
    {
        return [
            CancelTaskAction::class,
            ResponseTaskAction::class,
            CompleteTaskAction::class,
            DenyTaskAction::class,
        ];
    }

    public function getNextStatus(AbstractTaskAction $action): ?string
    {
        $map = [
            CompleteTaskAction::class => self::STATUS_IN_PROGRESS,
            CancelTaskAction::class => self::STATUS_CANCEL,
            DenyTaskAction::class => self::STATUS_CANCEL,
        ];

        return $map[get_class($action)] ?? null;
    }

    public function statusAllowedActions(string $status): array
    {
        $map = [
            self::STATUS_NEW => [CancelTaskAction::class, ResponseTaskAction::class],
            self::STATUS_IN_PROGRESS => [CompleteTaskAction::class, DenyTaskAction::class],
        ];

        return $map[$status] ?? [];
    }

    public function roleAllowedActions(string $role): array
    {
        $this->checkRole($role);

        $map = [
            self::ROLE_PERFORMER => [DenyTaskAction::class, ResponseTaskAction::class],
            self::ROLE_CUSTOMER => [CompleteTaskAction::class, CancelTaskAction::class],
        ];

        return $map[$role] ?? [];
    }

    public function checkRole(string $role): void
    {
        $availableRoles = [self::ROLE_PERFORMER, self::ROLE_CUSTOMER];

        if (!in_array($role, $availableRoles)) {
            throw new RoleActionException("Неизвестный роль: $role");
        }
    }

    public function setStatus(string $status): void
    {
        $availableStatuses = [
            self::STATUS_NEW,
            self::STATUS_CANCEL,
            self::STATUS_IN_PROGRESS,
            self::STATUS_COMPLETE,
            self::STATUS_EXPIRED,
        ];

        if (!in_array($status, $availableStatuses)) {
            throw new StatusActionException("Неизвестный статус: $status");
        }

        $this->currentStatus = $status;
    }
}

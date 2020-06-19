<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Domain\Model\User\Exception;

use AdnanMula\Chronogg\Notifier\Domain\Model\Shared\Exception\NotFoundException;

final class UserNotExistsException extends NotFoundException
{
    public function __construct()
    {
        parent::__construct('User not exists.');
    }
}

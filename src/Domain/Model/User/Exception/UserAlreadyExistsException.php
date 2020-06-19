<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Domain\Model\User\Exception;

use AdnanMula\Chronogg\Notifier\Domain\Model\Shared\Exception\ExistsException;

final class UserAlreadyExistsException extends ExistsException
{
    public function __construct()
    {
        parent::__construct('User already exists.');
    }
}

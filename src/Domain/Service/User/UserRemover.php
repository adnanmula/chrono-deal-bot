<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Domain\Service\User;

use AdnanMula\Chronogg\Notifier\Domain\Model\User\Exception\UserAlreadyExistsException;
use AdnanMula\Chronogg\Notifier\Domain\Model\User\Exception\UserNotExistsException;
use AdnanMula\Chronogg\Notifier\Domain\Model\User\User;
use AdnanMula\Chronogg\Notifier\Domain\Model\User\UserRepository;
use AdnanMula\Chronogg\Notifier\Domain\Model\User\ValueObject\UserId;
use AdnanMula\Chronogg\Notifier\Domain\Model\User\ValueObject\UserReference;
use AdnanMula\Chronogg\Notifier\Domain\Model\User\ValueObject\UserUsername;

final class UserRemover
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserReference $reference): void
    {
        $user = $this->repository->byReference($reference);

        if (null === $user) {
            throw new UserNotExistsException();
        }

        $this->repository->remove($user);
    }
}

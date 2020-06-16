<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Infrastructure\Persistence\Repository\User;

use AdnanMula\Chronogg\Notifier\Domain\Model\User\User;
use AdnanMula\Chronogg\Notifier\Domain\Model\User\UserRepository;
use AdnanMula\Chronogg\Notifier\Domain\Model\User\ValueObject\UserId;
use AdnanMula\Chronogg\Notifier\Domain\Model\User\ValueObject\UserReference;
use AdnanMula\Chronogg\Notifier\Infrastructure\Persistence\Repository\DbalRepository;

final class UserDbalRepository extends DbalRepository implements UserRepository
{
    public function all(): array
    {
        // TODO: Implement all() method.
    }

    public function byId(UserId $id): ?User
    {
        // TODO: Implement byId() method.
    }

    public function byReference(UserReference $reference): ?User
    {
        // TODO: Implement byReference() method.
    }

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }

    public function remove(User $user): void
    {
        // TODO: Implement remove() method.
    }
}

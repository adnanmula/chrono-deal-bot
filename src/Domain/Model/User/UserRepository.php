<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Domain\Model\User;

use AdnanMula\Chronogg\Notifier\Domain\Model\User\ValueObject\UserId;
use AdnanMula\Chronogg\Notifier\Domain\Model\User\ValueObject\UserReference;

interface UserRepository
{
    /** @return array<User> */
    public function all(): array;
    public function byId(UserId $id): ?User;
    public function byReference(UserReference $reference): ?User;
    public function save(User $user): void;
    public function remove(User $user): void;
}

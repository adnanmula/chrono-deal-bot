<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Application\User\Unsubscribe;

use AdnanMula\Chronogg\Notifier\Domain\Model\User\ValueObject\UserId;
use AdnanMula\Chronogg\Notifier\Domain\Model\User\ValueObject\UserReference;
use AdnanMula\Chronogg\Notifier\Domain\Model\User\ValueObject\UserUsername;
use Assert\Assert;

final class UnsubscribeUserCommand
{
    public const COMMAND = 'unsubscribe';

    private UserId $id;
    private UserReference $reference;

    public function __construct($id, $reference)
    {
        Assert::lazy()
            ->that($id, 'id')->uuid()
            ->that($reference, 'reference')->string()->notBlank()
            ->verifyNow();

        $this->id = UserId::from($id);
        $this->reference = UserReference::from($reference);
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function reference(): UserReference
    {
        return $this->reference;
    }
}

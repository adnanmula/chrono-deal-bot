<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Domain\Model\Shared\ValueObject;

use Ramsey\Uuid\Uuid;

class UuidValueObject extends StringValueObject
{
    public static function from(string $value): self
    {
        return new static(Uuid::fromString($value)->toString());
    }

    public static function v4(): self
    {
        return new static(Uuid::uuid4()->toString());
    }
}

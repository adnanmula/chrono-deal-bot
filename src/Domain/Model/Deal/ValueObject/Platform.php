<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject;

final class Platform
{
    public const PLATFORM_STEAM = 'steam';
    public const PLATFORM_EPIC = 'epic';
    public const PLATFORM_UPLAY = 'uplay';
    public const PLATFORM_ORIGIN = 'origin';

    public static $allowedValues = [
        self::PLATFORM_STEAM,
        self::PLATFORM_EPIC,
        self::PLATFORM_UPLAY,
        self::PLATFORM_ORIGIN,
    ];

    private string $value;

    private function __construct($value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    public static function from($value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    private function guard($value): void
    {
        if (false === $this->isValid($value)) {
            throw new \InvalidArgumentException(
                \sprintf(
                    '<%s> not allowed value, allowed values: <%s> for enum class <%s>',
                    $value,
                    \implode(' ', static::$allowedValues),
                    static::class,
                ),
            );
        }
    }

    private function isValid($value): bool
    {
        return \in_array($value, static::$allowedValues, true);
    }
}

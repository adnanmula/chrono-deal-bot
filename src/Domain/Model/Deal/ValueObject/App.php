<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject;

final class App
{
    private string $name;
    private string $description;

    private function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public static function from(string $name, string $description): self
    {
        return new self($name, $description);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }
}
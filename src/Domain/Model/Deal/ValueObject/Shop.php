<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject;

final class Shop
{
    public const SHOP_CHRONO = 'chrono.gg';

    private string $name;
    private string $url;
    private string $dealUrl;

    public function __construct(string $name, string $url, string $dealUrl)
    {
        $this->name = $name;
        $this->url = $url;
        $this->dealUrl = $dealUrl;
    }

    public static function from(string $name, string $url, string $dealUrl): self
    {
        return new self($name, $url, $dealUrl);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function dealUrl(): string
    {
        return $this->dealUrl;
    }
}

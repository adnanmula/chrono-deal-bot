<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject;

use Money\Currency;
use Money\Money;

final class Price
{
    private Money $normalPrice;
    private Money $salePrice;
    private int $discount;
    private Currency $currency;

    public function __construct(Money $normalPrice, Money $salePrice, int $discount, Currency $currency)
    {
        $this->normalPrice = $normalPrice;
        $this->salePrice = $salePrice;
        $this->discount = $discount;
        $this->currency = $currency;
    }

    public static function from(Money $normalPrice, Money $salePrice, int $discount, Currency $currency): self
    {
        return new self($normalPrice, $salePrice, $discount, $currency);
    }

    public function normalPrice(): Money
    {
        return $this->normalPrice;
    }

    public function salePrice(): Money
    {
        return $this->salePrice;
    }

    public function discount(): int
    {
        return $this->discount;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }
}

<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Domain\Model\Deal;

use AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject\App;
use AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject\Date;
use AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject\Platform;
use AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject\Price;
use AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject\Shop;

final class Deal
{
    private App $app;
    private Platform $platform;
    private Shop $shop;
    private Price $price;
    private Date $date;

    public function __construct(App $app, Platform $platform, Shop $shop, Price $price, Date $date)
    {
        $this->app = $app;
        $this->platform = $platform;
        $this->shop = $shop;
        $this->price = $price;
        $this->date = $date;
    }

    public static function create(App $app, Platform $platform, Shop $shop, Price $price, Date $date): self
    {
        return new self($app, $platform, $shop, $price, $date);
    }

    public function app(): App
    {
        return $this->app;
    }

    public function platform(): Platform
    {
        return $this->platform;
    }

    public function shop(): Shop
    {
        return $this->shop;
    }

    public function price(): Price
    {
        return $this->price;
    }

    public function date(): Date
    {
        return $this->date;
    }
}

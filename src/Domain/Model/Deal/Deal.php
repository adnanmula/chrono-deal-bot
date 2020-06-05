<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Domain\Model\Deal;

final class Deal
{
    private App $app;
    private Platform $platform;
    private Shop $shop;
    private Price $price;
    private Date $date;

    public function __construct()
    {
    }
}

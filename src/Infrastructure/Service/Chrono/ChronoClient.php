<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Infrastructure\Service\Chrono;

use AdnanMula\Chronogg\Notifier\Domain\Model\Deal\Deal;
use AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject\App;
use AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject\Date;
use AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject\Platform;
use AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject\Price;
use AdnanMula\Chronogg\Notifier\Domain\Model\Deal\ValueObject\Shop;
use GuzzleHttp\Client;
use Money\Currency;
use Money\Money;

class ChronoClient extends Client
{
    private const URL_API = 'https://api.chrono.gg';
    private const SALE_ENDPOINT = '/sale';

    public function __construct()
    {
        parent::__construct([]);
    }

    public function currentDeal(): ?Deal
    {
        $response = $this->get(self::URL_API . self::SALE_ENDPOINT);

        $rawResponse = \json_decode($response->getBody()->getContents(), true);

        return $this->map($rawResponse);
    }

    private function map(array $result): Deal
    {
        return Deal::create(
            App::from($result['name'], ''),
            Platform::from(Platform::PLATFORM_STEAM),
            Shop::from(Shop::SHOP_CHRONO, $result['url'], $result['unique_url']),
            Price::from(
                Money::USD(\round($result['normal_price'] * 100, 0)),
                Money::USD(\round($result['sale_price'] * 100, 0)),
                (int) $result['discount'],
                new Currency($result['currency'])
            ),
            Date::from(new \DateTimeImmutable($result['start_date']), new \DateTimeImmutable($result['end_date']))
        );
    }
}

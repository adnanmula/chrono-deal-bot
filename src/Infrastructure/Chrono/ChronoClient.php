<?php declare(strict_types=1);

namespace AdnanMula\Chronogg\Notifier\Infrastructure\Chrono;

use AdnanMula\Chronogg\Notifier\Domain\Model\Deal\Deal;
use GuzzleHttp\Client;

class ChronoClient extends Client
{
    private const URL_API = 'https://api.chrono.gg';
    private const SALE_ENDPOINT = '/sale';

    private string $apiKey;

    public function __construct()
    {
        parent::__construct([]);
    }

    public function currentDeal(): ?Deal
    {
        $response = $this->get(self::URL_API . self::SALE_ENDPOINT);

        $rawResponse = \json_decode($response->getBody()->getContents(), true);

        dd($rawResponse);

//        if (false === \array_key_exists('response', $rawResponse)) {
//            return null;
//        }

        return $this->map($rawResponse['response']);
    }

    private function map(array $result): ?Deal
    {
    }
}
